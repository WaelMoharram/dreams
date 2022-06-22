<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Favourite extends Model
{

    protected $table = 'favourites';
    public $timestamps = true;


    protected $guarded = array('id');

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favourable()
    {
        return $this->morphTo();
    }



}
