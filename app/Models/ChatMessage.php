<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $table='chat_messages';
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

    public function channel(){
        return $this->belongsTo(ChatChannel::class,'channel_id');
    }

    public function from(){
        return $this->belongsTo(User::class,'from_id');
    }

    public function to(){
        return $this->belongsTo(User::class,'to_id');
    }
}
