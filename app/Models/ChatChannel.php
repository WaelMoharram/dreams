<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatChannel extends Model
{
    use HasFactory;
    protected $table='chat_channels';
    protected $guarded=['id'];

    public function provider(){
        return $this->belongsTo(User::class,'provider_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function messages(){
        return $this->hasMany(ChatMessage::class,'channel_id');
    }
}
