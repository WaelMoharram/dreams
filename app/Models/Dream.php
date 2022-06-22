<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dream extends Model 
{

    protected $table = 'dreams';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'title');

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'dream_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

}