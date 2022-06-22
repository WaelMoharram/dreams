<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    use SoftDeletes,HasTranslations;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name','image','is_sell','is_rent','is_transportation','upper_id');
    public $translatable = ['name'];

    public function subs(){
        return $this->hasMany(Category::class,'upper_id');
    }


}
