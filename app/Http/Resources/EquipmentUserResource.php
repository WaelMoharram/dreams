<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentUserResource extends JsonResource
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
            "name"=> $this->name ?? "" ,
            "note"=> $this->note ?? "" ,
            "image"=> $this->image ? url($this->image) : "",
            "is_favourite" => $this->is_favourite,
            "share_link"=> '#'

        ];
    }
}
