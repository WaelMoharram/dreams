<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OfferAcceptRejectRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SMSRequest;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\Nationality;
use App\Models\Offer;
use App\Models\OfferComment;
use App\Models\OfferDetail;
use App\Models\OfferImage;
use App\Models\OfferLog;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class OfferController extends Controller
{

    use ApiResponse;

    public function index(Request $request){



        $orders = Offer::where('seen',1)->where('accepted',1)->where(function ($q) use ($request){
            if ($request->has('category_id') && $request->category_id != null){
                $q->where('category_id',$request->category_id);
            }
            if ($request->has('name') && $request->name != null){
                $q->where('title','like', '%'.$request->name.'%');
            }
            if ($request->has('city_id') && $request->city_id != null){
                $q->where('city_id',$request->city_id);
            }
        })->orderBy('id','desc')->paginate(10);

        return $this->okApiResponse(OfferResource::collection($orders)->response()->getData(true),__('Offers loaded'));
    }

    public function store(Request $request)
    {
        $requests = $request->except('images');
        $requests['user_id'] = Auth::id();
        $offer = Offer::create($requests);

        if ($request->has('images') && $request->images != null) {
            foreach ($request->images as $image) {
                $saved = $this->saveImage($image);

                OfferImage::create([
                    'offer_id' => $offer->id,
                    'url' => $saved,
                ]);
            }

        }
        return $this->okApiResponse([], __('Offer created successfully'));
    }
    public function update(Request $request)
    {

        $requests = $request->except('images','id');

        $offer = Offer::find($request->id)->fill($requests)->save();
        if ($request->has('images') && $request->images != null) {
            foreach ($request->images as $image) {
                $saved = $this->saveImage($image);

                OfferImage::create([
                    'offer_id' => $request->id,
                    'url' => $saved,
                ]);
            }

        }
        return $this->okApiResponse([], __('Offer Edited successfully'));
    }


    public function myOffers(Request $request){


        $orders = Offer::where('user_id',Auth::id())->orderBy('id','desc')->paginate(10);
        return $this->okApiResponse(OfferResource::collection($orders)->response()->getData(true),__('Offers loaded'));
    }

    public function delete($id) {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return $this->okApiResponse([],__("Offer Deleted successfully"));

    }

    public function favourite($id) {
        $offer = Offer::findOrFail($id);
        if ($offer->favourite()->where('user_id',Auth::id())->count() == 0){
            $offer->favourite()->create(['user_id'=>Auth::id()]);
        }else{
            $offer->favourite()->where('user_id',Auth::id())->delete();
        }
        return $this->okApiResponse(['is_favourite'=>$offer->is_favourite],__("Offer change favourite status successfully"));
    }
    public function comment($id,Request $request) {
        $requests = $request->all();
        $requests['offer_id']=$id;
        $requests['user_id']=Auth::id();

        OfferComment::create($requests);
        return $this->okApiResponse([],__("Comment created successfully"));
    }


    public function switchSeen($id) {
        $offer = Offer::findOrFail($id);
        if ($offer->seen == 0){
            $offer->fill(['seen'=>1]);
        }else{
            $offer->fill(['seen'=>0]);
        }
        $offer->save();

        return $this->okApiResponse(['seen'=>$offer->seen],__("Offer switched successfully"));

    }

    public function rateOffer(Request $request)
    {
        $order = Offer::find($request->order_id);
        if (is_null($order)) {
            return $this->notFoundApiResponse([],__('Offer not found'));
        }


        $order->rate = $request->rate ?? 0;
        $order->rate_comment = $request->rate_comment ?? '';
        $order->save();
        return $this->okApiResponse(new OfferResource($order),__("Offer rated"));


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
