<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    protected $appends=['is_favourite'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function images(){
        return $this->hasMany(OfferImage::class,'offer_id');
    }
    public function comments(){
        return $this->hasMany(OfferComment::class,'offer_id');
    }

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
