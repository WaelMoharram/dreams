<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OrderAcceptRejectRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SMSRequest;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\Coupon;
use App\Models\EquipmentUser;
use App\Models\Nationality;
use App\Models\OfferImage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderImage;
use App\Models\OrderLog;
use App\Models\Payment\Payment;
use App\Models\Token;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    use ApiResponse;

    public function index(Request $request){



        $orders = Order::where('user_id',Auth::id())->where('status','new')->whereHas('store',function ($q) use ($request){
            $q->where(function ($q2) use($request){
                //todo:: fron seller
                if ($request->has('city_id') && $request->city_id > 0){
                    $q2->where('city_id',$request->city_id);
                }
            });
        })->orderBy('id','desc')->paginate(10);

        return $this->okApiResponse(OrderResource::collection($orders)->response()->getData(true),__('Orders loaded'));
    }



    public function store(Request $request){
        $requests = $request->all();
        $requests['order_time']= date('H:i:s',strtotime($request->order_time));
        $requests['user_id'] = Auth::id();
        $requests['provider_id'] = EquipmentUser::find($request->equipment_id)->user_id;
        $requests['equipment_user_id'] = $request->equipment_id;
        unset($requests['equipment_id']);
        $requests['status'] = 'new';

        $order = Order::create($requests);
        if ($request->has('images') && $request->images != null) {
            foreach ($request->images as $image) {
                $saved = $this->saveImage($image);

                OrderImage::create([
                    'order_id' => $order->id,
                    'url' => $saved,
                ]);
            }

        }
        $tokens =Token::whereIn('user_id',[$requests['user_id'],$requests['provider_id']])->pluck('token');
        firebase_notification('New order created','Order NO.'.$order->id.'has been created',$tokens,'');
        return $this->okApiResponse([],__('Order created successfully'));
    }

    public function price(OrderAcceptRejectRequest $request){
        $order = Order::find($request->order_id);
        if (!$order || $order->provider_id != Auth::id() || $order->status != Order::STATUS_NEW){
            if ($order->provider_id != Auth::id()){
                return $this->unauthorizedApiResponse([],__('You are not this order provider'));
            }
            if ($order->status != Order::STATUS_NEW){
                return $this->unauthorizedApiResponse([],__('Order not new'));
            }
            return $this->unauthorizedApiResponse([],__('Not authorized'));
        }
        $order->status = Order::STATUS_PRICED;
        $order->price = $request->price;
        $order->price_note = $request->price_note;
        $order->save();
        OrderLog::create(
            [
                'order_id'=>$order->id,
                'user_id'=>Auth::id(),
                'log'=>'provider priced the order'
            ]
        );
        $tokens =Token::whereIn('user_id',[$order->user_id,$order->provider_id])->pluck('token');
        firebase_notification('Order accepted successfully','Order accepted successfully',$tokens,'');
        return $this->okApiResponse([],__('Order accepted successfully'));

    }
    public function acceptPrice(OrderAcceptRejectRequest $request){
        $order = Order::find($request->order_id);
        if (!$order || $order->user_id != Auth::id() || $order->status != Order::STATUS_PRICED){

            if ($order->user_id != Auth::id()){
                return $this->unauthorizedApiResponse([],__('Not your order'));
            }

            if ($order->status != Order::STATUS_PRICED){
                return $this->unauthorizedApiResponse([],__('Order not prices'));
            }

            return $this->unauthorizedApiResponse([],__('Not authorized'));
        }

        OrderLog::create(
            [
                'order_id'=>$order->id,
                'user_id'=>Auth::id(),
                'log'=>'try to paid order the order'
            ]
        );
if ($request->has('coupon') && $request->coupon != null && $request->coupon != ''){
    $vat = option('vat');

    $coupon = Coupon::where('code',$request->coupon)->first();
    $orderupdate = Order::find($request->order_id);

    if (!$coupon){
        $vatValue = (($request->total)*$vat)/100;

        $orderupdate->update([
            'discount'=>0,
            'vat'=>$vatValue,

        ]);
    }

    if ($coupon->type == 'amount' && $request->total > $coupon->value){

        $vatValue = (($request->total - $coupon->value)*$vat)/100;
        $orderupdate->update([
            'discount'=>$coupon->value,
            'vat'=>$vatValue,

        ]);

    }elseif($coupon->type == 'amount' && $request->total <= $coupon->value){
        $vatValue = (($request->total)*$vat)/100;
        $orderupdate->update([
            'discount'=>0,
            'vat'=>$vatValue,

        ]);
    }

    if ($coupon->type == 'percent' ){
        $vat = option('vat');

        $discount = ($request->total *$coupon->value)/100;
        $vatValue = (($request->total - $discount)*$vat)/100;
        $orderupdate->update([
            'discount'=>$discount,
            'vat'=>$vatValue,

        ]);

    }
}
        if($request->payment_type == 'cash'){
            $order->fill(['status'=>\App\Models\Order::STATUS_WORKING])->save();
            $tokens =Token::whereIn('user_id',[$order->user_id,$order->provider_id])->pluck('token');
            firebase_notification('Order paid successfully','Order paid successfully',$tokens,'');
            return $this->okApiResponse([],__('Order paid successfully'));

        }
        $order = Order::find($request->order_id);

        $items[] = [
            "ItemName"   => optional($order->equipmentUser)->name ?? '',
            "Quantity"   => 1,
            "UnitPrice"  => $order->price,
        ];
        $payment = new \App\Helpers\Payment\Payment();
        $payment = $payment->setCustomer([
            'name' => $order->user->name,
            'code' => '966',
            'mobile' => $order->user->phone ?? '523145687',
            'email' => $order->user->email,
        ])->setAddress([
            'block' => 'defult',
            'street' => 'defult',
            'building' => 'defult',
            'address' => $order->address->name ?? '',
            'instructions' => 'defult',
        ])->setItems($items)
            ->setTotal($order->price )
            ->setCallBackUrl(route('payment_redirect', ['type'=>'success','order_id'=>$order->id]))
            ->setErrorUrl(route('payment_redirect', ['type'=>'error','order_id'=>$order->id]));
        $payment = $payment->getInvoiceURL($order->id);
        return $this->okApiResponse([$payment],__('Invoice url'));

        return $payment;
    }

    public function cancel(OrderAcceptRejectRequest $request){
        $order = Order::find($request->order_id);
        if ( $order->status == Order::STATUS_FINISHED  ){
            return $this->unauthorizedApiResponse([],__('Can not cancel finished order'));
        }
        $order->status = Order::STATUS_CANCELLED;
        $order->save();
        OrderLog::create(
            [
                'order_id'=>$order->id,
                'user_id'=>Auth::id(),
                'log'=>'user cancel order'
            ]
        );
        $tokens =Token::whereIn('user_id',[$order->user_id,$order->provider_id])->pluck('token');
        firebase_notification('Order cancelled','Order cancelled',$tokens,'');
        return $this->okApiResponse([],__('Order cancelled'));

    }

    public function finish(OrderAcceptRejectRequest $request){
        $order = Order::find($request->order_id);
        if ( $order->status != Order::STATUS_WORKING){
            return $this->unauthorizedApiResponse([],__('Order must be working to finish it'));
        }
        $order->status = Order::STATUS_FINISHED;
        $order->save();
        OrderLog::create(
            [
                'order_id'=>$order->id,
                'user_id'=>Auth::id(),
                'log'=>'user finish order'
            ]
        );
        $tokens =Token::whereIn('user_id',[$order->user_id,$order->provider_id])->pluck('token');
        firebase_notification('Order finished','Order finished',$tokens,'');
        return $this->okApiResponse([],__('Order finished'));

    }

    public function myOrders(Request $request){
        $orders = Order::where(function($q) use ($request){
            if (Auth::user()->main_role =='client'){
                $q->where('user_id',Auth::id());
            }else{
                $q->where('provider_id',Auth::id());
            }

            if ($request->status != 'all'){
                $q->where('status',$request->status);
            }
            if ($request->type){
                $q->where('type',$request->type);
            }
        })->orderBy('id','desc')->paginate(10);
        return $this->okApiResponse(OrderResource::collection($orders)->response()->getData(true),__('Orders loaded'));
    }

    public function SMS(SMSRequest $request)
    {
        //todo seller or client
        $order = Order::find($request->order_id);

        $order->sms_code   = 123456;
        $order->save();
        return $this->okApiResponse(['sms_code' => $order->sms_code],__("Check SMS code"));

    }

    public function sellerConfirm(Request $request)
    {
        $order = Order::find($request->order_id);
        if (is_null($order)) {
            return $this->notFoundApiResponse([],__('Order not found'));
        }
        if($order->sms_code != $request->sms_code) {
            return $this->badRequestApiResponse(['sms_code invalid'],__('The code is not valid.'));

        }

        $order->status = 'picked';
        $order->save();
        return $this->okApiResponse(new OrderResource($order),__("Confirmed Order"));


    }


    public function ClientConfirm(Request $request)
    {
        $order = Order::find($request->order_id);
        if (is_null($order)) {
            return $this->notFoundApiResponse([],__('Order not found'));
        }
        if($order->sms_code != $request->sms_code) {
            return $this->badRequestApiResponse(['sms_code invalid'],__('The code is not valid.'));

        }

        $order->status = 'delivered';
        $order->save();
        return $this->okApiResponse(new OrderResource($order),__("Confirmed Order"));


    }

    public function rateOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        if (is_null($order)) {
            return $this->notFoundApiResponse([],__('Order not found'));
        }


        $order->rate = $request->rate ?? 0;
        $order->rate_comment = $request->rate_comment ?? '';
        $order->save();
        $tokens =Token::whereIn('user_id',[$order->user_id,$order->provider_id])->pluck('token');
        firebase_notification('Order finished','Order NO. '.$order->id.' rated',$tokens,'');
        return $this->okApiResponse(new OrderResource($order),__("Order rated"));


    }

    function coupon(Request $request){
        $vat = option('vat');

        $coupon = Coupon::where('code',$request->code)->first();
        if (!$coupon){
            $vatValue = (($request->total)*$vat)/100;

            return $this->okApiResponse([
                'total'=>$request->total,
                'discount'=>0,
                'vat_percent'=>$vat,
                'vat_value'=>$vatValue,
                'total_after_discount'=>$request->total + $vatValue
            ],__("Order details"));
        }

        if ($coupon->type == 'amount' && $request->total > $coupon->value){

            $vatValue = (($request->total - $coupon->value)*$vat)/100;

            return $this->okApiResponse([
                'total'=>$request->total,
                'discount'=>$coupon->value,
                'vat_percent'=>$vat,
                'vat_value'=>$vatValue,
                'total_after_discount'=>$request->total - $coupon->value + $vatValue
            ],__("Order details"));
        }elseif($coupon->type == 'amount' && $request->total <= $coupon->value){
            $vatValue = (($request->total)*$vat)/100;
            return $this->okApiResponse([
                'total'=>$request->total,
                'discount'=>0,
                'vat_percent'=>$vat,
                'vat_value'=>$vatValue,
                'total_after_discount'=>$request->total + $vatValue
            ],__("Order details"));
        }

        if ($coupon->type == 'percent' ){
            $vat = option('vat');

            $discount = ($request->total *$coupon->value)/100;
            $vatValue = (($request->total - $discount)*$vat)/100;

            return $this->okApiResponse([
                'total'=>$request->total,
                'discount'=>$discount,
                'vat_percent'=>$vat,
                'vat_value'=>$vatValue,
                'total_after_discount'=>$request->total - $discount + $vatValue
            ],__("Order details"));
        }
    }
    function saveImage($file, $folder = '/')
    {
        request()->files->remove('link');

        $fileName = time() . rand(10,99).$file->getClientOriginalName();
        $dest = public_path('/uploads/' . $folder);
        $file->move($dest, $fileName);

        $uploaded_file = 'uploads/' . $folder . '/' . $fileName;
        return $uploaded_file;
    }
}
