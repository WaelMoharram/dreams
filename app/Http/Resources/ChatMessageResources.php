<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResources extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {

        return [
            'id' => $this->id,
            'channel_id' => $this->channel_id ?? '',
            'message' => $this->message ?? '',
            'from_id' => $this->from_id ?? '',
            'to_id' => $this->to_id ?? '',
            'time' =>date('H:i:s' ,strtotime($this->created_at)),
            'image' => $this->image ? url($this->image) : ''
        ];
    }

}
