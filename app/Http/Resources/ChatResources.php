<?php

namespace App\Http\Resources;

use App\Models\ChatMessage;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChatResources extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        $time = '';
if (ChatMessage::where('channel_id',$this->id)->orderByDesc('id')->first()){
    $time = date('Y-m-d H:i:s',strtotime(ChatMessage::where('channel_id',$this->id)->orderByDesc('id')->first()->created_at));
}
if(Auth::user()->main_role == 'provider'){
    return [
        'id' => $this->id,
        'user' => new UserResource($this->user),
        'last_message' => ChatMessage::where('channel_id',$this->id)->orderByDesc('id')->first()->message ?? '',
        'last_message_time' =>$time
    ];
}
        return [
            'id' => $this->id,
            'user' => new UserResource($this->provider),
            'last_message' => ChatMessage::where('channel_id',$this->id)->orderByDesc('id')->first()->message ?? '',
            'last_message_time' =>$time
        ];
    }

}
