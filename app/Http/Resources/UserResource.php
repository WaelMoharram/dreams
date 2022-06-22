<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "created_at"=> $this->created_at->format('Y-m-d'),
            "name"=> $this->name,
            "id_image"=> $this->id_image? url($this->id_image): '',
            "email"=> $this->email,
            "mobile"=> $this->mobile,
            "image"=> $this->image? url($this->image): '',
            "city_id"=> $this->city_id?? '',
            "city"=> $this->city->name?? '',
            "account_type" =>$this->account_type,
            "sms_code"=> $this->sms_code ?? '',
            "transportation_services"=>$this->transportation_services ??'',
            "rent_services"=>$this->rent_services ??'',
            "sell_services"=>$this->sell_services ??'',
            "api_token"=> $this->api_token ?? '',
            "notification_status"=> $this->notification_status,
            "is_active"=>$this->is_active
        ];
    }
}
