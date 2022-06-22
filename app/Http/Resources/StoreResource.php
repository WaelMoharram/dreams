<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'created_at'            => $this->created_at->format('Y-m-d'),
            'name'                  => $this->name ??'',
            "email"                 => $this->email ??'',
            "mobile"                => $this->mobile ??'',
            "commercial_register"   => $this->commercial_register ??'',
            "percent"               => $this->percent ??'',
            "city_id"               => $this->city_id ??'',
            "city"                  => new CityResource($this->city) ?? '',
            "status"                => $this->status ??'',
            "orders_total"          => Order::where('store_id',$this->seller_id)->count() ?? 0,
            "order_total_percent"   => floatval((Order::where('store_id',$this->seller_id)->sum('total') * $this->percent)/100) ?? 0
        ];
    }
}
