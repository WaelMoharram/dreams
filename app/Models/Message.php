<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model 
{

    protected $table = 'messages';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('dream_id', 'user_id', 'message');

    public function dreams()
    {
        return $this->belongsTo('App\Models\Dream');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}