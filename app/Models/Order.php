<?php

namespace App\Models;

use App\Http\Resources\OrderImageResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    const TYPE_RENT='rent';
    const TYPE_TRANSPORTATION='transportation';

    const STATUS_NEW='new';
    const STATUS_PRICED='priced';
    const STATUS_WORKING='working';
    const STATUS_CANCELLED='cancelled';
    const STATUS_FINISHED='finished';


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id');
    }
    public function equipmentUser()
    {
        return $this->belongsTo(EquipmentUser::class,'equipment_user_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function images(){
        return $this->hasMany(OrderImage::class,'order_id');
    }

    public function getPriceAttribute(){
        if ($this->attributes['coupon_id'] != null){
            return $this->attributes['price'] - $this->attributes['discount'] +$this->attributes['vat'] ;
        }

        return $this->attributes['price']+$this->attributes['vat'];
    }



}
