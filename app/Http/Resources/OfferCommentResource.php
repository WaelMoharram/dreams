<?php

namespace App\Http\Resources;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferCommentResource extends JsonResource
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
            //"user"=>new UserResource($this->user),
            "user_name"=>$this->user->name ?? '',
            "user_image"=>url($this->user->image) ?? '',
            "name"=>$this->name ?? '',
            "comment"=> $this->comment ?? '',
            "rate" =>$this->rate ?? 0
        ];
    }
}
