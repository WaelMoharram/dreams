<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            "id"=> $this->id,
            "order_id"=> $this->order_id ??'',
            "name"=> $this->name ??'',
            "model"=> $this->model ??'',
            "quantity"=> $this->quantity ??'',
            "price"=> $this->price ??'',
            "total"=> $this->total ??'',
            "image"=> $this->image ??'',
            "weight" => '' //TODO:: weight_value from api
        ];
    }
}
