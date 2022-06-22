<?php

namespace App\Http\Resources;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $latlng=null;
//        if ($this->lat_lng){
//        $latlng = explode(",", $this->lat_lng);
//        }
//
//        if (request()->has('lat') && request()->lat != '' && request()->lat != null && request()->has('lng') && request()->lng != '' && request()->lng != null && $latlng != null){
//            $distance = vincentyGreatCircleDistance(request()->lat,request()->lng,$latlng[0],$latlng[1]);
//
//        }else{
//            $distance = 0;
//        }
        return [
            "id"=> $this->id,
            "user"=>new UserResource($this->user),
            "provider"=>new UserResource($this->provider),
            "equipment"=>new EquipmentUserResource($this->equipmentUser),
            "price"=>$this->price ?? 0,
            "price_note"=>$this->price_note ?? '',
            "days"=>$this->days ?? 0,
            "start_date" =>$this->start_date ??'',
            "end_date" =>$this->end_date ?? '',
            "order_time" => $this->order_time ?? '',
            "mobile" =>$this->mobile ?? '',
            "city" =>new CityResource($this->city) ?? '',
            "lat"=>$this->lat ?? 0,
            "lng" =>$this->lng  ?? 0,
            "info" =>$this->info ?? '',
            "images" =>OrderImageResource::collection($this->images),
            "type" =>$this->type ?? '',
            "status"=>$this->status ?? '',
            "rate"=>(int)$this->rate ?? 0,
            "rate_comment"=>$this->rate_comment
        ];
    }
}
