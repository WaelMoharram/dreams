<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Tasawk\Locations\Models\Zone;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;

    use SoftDeletes,HasTranslations;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name','boundaries');
    public $translatable = ['name'];
    protected $casts = [
        "boundaries" => "json"
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }


    public function zones(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(\App\Models\Zone::class, "city_id");
    }

}
