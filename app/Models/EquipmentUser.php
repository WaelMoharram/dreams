<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class EquipmentUser extends Model
{

    protected $table = 'equipment_user';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
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
