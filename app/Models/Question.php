<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model 
{

    protected $table = 'questions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('question', 'is_required');

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id');
    }

}