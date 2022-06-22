<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class OfferImage extends Model
{

    protected $table = 'offer_images';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }




}
