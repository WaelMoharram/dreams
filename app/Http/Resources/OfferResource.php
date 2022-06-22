<?php

namespace App\Http\Resources;

use App\Models\Favourite;
use App\Models\OfferImage;
use App\Models\Store;
use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            "category_id" => $this->category_id ?? 0,
            "user"=> new UserResource($this->user) ??'',
            "title"=> $this->title ??'',
            "share_link"=> '#',
            "description"=> $this->description ??'',
            "how_to_use"=> $this->how_to_use ??'',
            "city"=> new CityResource($this->city),
            "images"=> OfferImageResource::collection($this->images),
            "seen" => $this->seen,
            "accepted" =>$this->accepted,
            "comments" =>OfferCommentResource::collection($this->comments),
            "is_favourite" => $this->is_favourite
        ];
    }
}
