<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Equipment extends Model
{

    protected $table = 'equipments';
    public $timestamps = true;

    use SoftDeletes,HasTranslations;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name','category_id');
    public $translatable = ['name'];


    public function favourite()
    {
        return $this->morphMany(Favourite::class, 'favourable');
    }

    public function getIsFavouriteAttribute(){
        $isFavourite =0;
        $count = $this->favourite->where('user_id',Auth::id())->count();
        if ($count > 0){
            $isFavourite =1;
        }

        return $isFavourite;
    }
}
