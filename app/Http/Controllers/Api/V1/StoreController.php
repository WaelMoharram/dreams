<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\Nationality;
use App\Models\Store;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class StoreController extends Controller
{

    use ApiResponse;

    public function index(Request $request){



        $stores = Store::where('user_id',Auth::id())->where(function ($q) use($request){

            if ($request->has('name') && $request->name != null && $request->name != ''){
                $q->where('name','like','%'.$request->name.'%');
            }

            if ($request->has('city_id') && $request->city_id > 0){
                $q->where('city_id',$request->city_id);
            }

        })->orderBy('id','desc')->paginate(10);

        return $this->okApiResponse(StoreResource::collection($stores)->response()->getData(true),__('Stores loaded'));
    }

    public function store(StoreRequest $request){

        $request->merge(['user_id' => Auth::id()]);
        $request->merge(['status' => 'new']);

        $response = Http::withHeaders([
            'x-mk-api' => 'dUYA9EJy79bd6eEZ'
        ])->asForm()->post('https://m-h.sa/index.php?route=mk_api/seller/create',
        [
            'store_name'=>$request->name,
            'telephone'=>$request->mobile,
            'email'=>$request->email,
            'comm_number'=>$request->commercial_register,
            'percentage'=>$request->percent,
            'zone'=>$request->city_id,
        ]);
//        if (!$response->json()['status_code'] == 200){
//            $this->badRequestApiResponse($response->json()['errors'],__('errors'))
//        }
        if ($response->json()['status_code'] == 200){
            $request->merge(['seller_id' => $response->json()['data']['seller_id']]);
        }
        $store = Store::create($request->all());
        return $this->okApiResponse(new StoreResource($store),__('Store created successfully'));
    }
    public function status(Request $request,$id){
        $store = Store::where('seller_id',$id)->first();
        if (!$store){
            return $this->notFoundApiResponse([],__('Store Not found'));

        }
        $store->status = $request->status;
        $store->save();
        return $this->okApiResponse([],__('Store updated successfully'));
    }
}
