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
            "email"=> $this->email,
            "mobile"=> $this->mobile,
            "image"=> $this->image? url($this->image): '',
            "account_type" =>$this->account_type,
            "api_token"=> $this->api_token ?? '',
            "notification_status"=> $this->notification_status,
        ];
    }
}
