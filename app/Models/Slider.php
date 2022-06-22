<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{

    protected $table = 'sliders';
    public $timestamps = true;


    protected $dates = ['deleted_at'];
    protected $fillable = array('image');



}
