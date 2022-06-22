<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class OrderDetail extends Model
{

    protected $table = 'order_details';
    public $timestamps = true;
    protected $guarded = array('id');

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
