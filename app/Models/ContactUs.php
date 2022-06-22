<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ContactUs extends Model
{

    protected $table = 'contact_us';
    public $timestamps = true;


    protected $guarded = array('id');


}
