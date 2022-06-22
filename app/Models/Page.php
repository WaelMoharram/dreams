<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{

    use HasTranslations;
    protected $table = 'pages';
    public $timestamps = true;
    public $translatable = ['content'];

    protected $fillable = array('title', 'content');

}
