<?php

namespace App\Models;

use App\Models\City;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

    protected $table = "zones";
    protected $guarded = ["id"];

    protected $casts = [
        "boundaries" => "json"
    ];

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(City::class, "city_id");
    }



}
