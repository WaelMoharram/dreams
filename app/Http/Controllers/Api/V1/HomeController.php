<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\EquipmentUserResource;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\EquipmentUser;
use App\Models\Nationality;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Store;
use App\Models\User;
use App\Traits\ApiResponse;
use Appstract\Options\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    use ApiResponse;

    public function aboutUs(){

        $page = Page::where('title','about us')->first();

        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    public function terms(){

        $page = Page::where('title','terms')->first();

        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    public function slider(){

        $slider = Slider::all();

        return $this->okApiResponse(SliderResource::collection($slider),__('page loaded'));
    }

    public function settings(){
        $opitons = Option::all();
        $array=[];
        foreach ($opitons as $option){
            $array[$option->key] =$option->value;
        }
        return $this->okApiResponse($array,__('Settings loaded'));
    }

    public function homeWallet(){
        $array=[
            'rent_equipments_count'=>50,
            'transportation_equipments_count'=>150,
            'rent_orders_count'=>250,
            'transportation_orders_count'=>350,
            'ads_count'=>20,
            'total_profit'=>35000
        ];
        return $this->okApiResponse($array,__(' loaded'));

    }

    public function wallet(){
        $array=[
            'wallet'=>1000,
            'transactions'=>[
                ['title'=>' تم الفاء الطلب رقم ٤٠٠','amount'=>500],
                ['title'=>' تم الفاء الطلب رقم ٤٠٠','amount'=>500],
                ['title'=>' تم الفاء الطلب رقم ٤٠٠','amount'=>500],
                ['title'=>' تم الفاء الطلب رقم ٤٠٠','amount'=>500],
            ]
        ];
        return $this->okApiResponse($array,__(' loaded'));

    }

    public function walletReport(){
        $array=[
            [
                'id'=>123,
                'created_at'=>'2022-05-20 15:15:15',
                'paid_at'=>'2022-05-20 15:15:15' ?? '',
                'cancelled_at'=>'2022-05-20 15:15:15' ?? '',
                'status'=>Order::STATUS_WORKING,
                'is_paid'=>true,
                'discount'=>300,
                'amount'=>1500
            ],
            [
                'id'=>124,
                'created_at'=>'2022-05-20 15:15:15',
                'paid_at'=>'2022-05-20 15:15:15' ?? '',
                'cancelled_at'=>'2022-05-20 15:15:15' ?? '',
                'status'=>Order::STATUS_FINISHED,
                'is_paid'=>true,
                'discount'=>300,
                'amount'=>1500
            ],
            [
                'id'=>125,
                'created_at'=>'2022-05-20 15:15:15',
                'paid_at'=>'2022-05-20 15:15:15' ?? '',
                'cancelled_at'=>'2022-05-20 15:15:15' ?? '',
                'status'=>Order::STATUS_CANCELLED,
                'is_paid'=>true,
                'discount'=>300,
                'amount'=>1500
            ],
        ];
        return $this->okApiResponse($array,__(' loaded'));

    }

    public function walletReportProvider(){
        $array=[
            'wallet'=>1000,
            'transactions'=>[
                [
                    'id'=>123,
                    'created_at'=>'2022-05-20 15:15:15',
                    'amount'=>1500,
                    'remaining_amount'=>1500
                ],[
                    'id'=>123,
                    'created_at'=>'2022-05-20 15:15:15',
                    'amount'=>1500,
                    'remaining_amount'=>1500
                ],[
                    'id'=>123,
                    'created_at'=>'2022-05-20 15:15:15',
                    'amount'=>1500,
                    'remaining_amount'=>1500
                ],[
                    'id'=>123,
                    'created_at'=>'2022-05-20 15:15:15',
                    'amount'=>1500,
                    'remaining_amount'=>1500
                ],[
                    'id'=>123,
                    'created_at'=>'2022-05-20 15:15:15',
                    'amount'=>1500,
                    'remaining_amount'=>1500
                ],
            ]
        ];
        return $this->okApiResponse($array,__(' loaded'));

    }
    public function search(Request $request){

        $rent = EquipmentUser::where('name','like', '%'.$request->name.'%')->where('for','rent')->get();
        $transportation = EquipmentUser::where('name','like', '%'.$request->name.'%')->where('for','transportation')->get();
        $offer = Offer::where('title','like', '%'.$request->name.'%')->get();

        return $this->okApiResponse(['rent'=>EquipmentUserResource::collection($rent),'transportation'=>EquipmentUserResource::collection($transportation),'offer'=>OfferResource::collection($offer)],__('results'));
    }


}
