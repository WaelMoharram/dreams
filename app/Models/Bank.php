<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Bank extends Model
{

    protected $table = 'banks';
    public $timestamps = true;

    use SoftDeletes,HasTranslations;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');
    public $translatable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
