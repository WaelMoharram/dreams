<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    const TYPE_INDIVIDUAL='individual';
    const TYPE_COMPANY='company';

    const ROLE_ADMIN='admin';
    const ROLE_CLIENT='client';
    const ROLE_SERVICE_PROVIDER='service_provider';

    const STATUS_NEW='new';
    const STATUS_ACTIVE='active';
    const STATUS_REJECTED='rejected';
    const STATUS_SUSPEND='suspend';

    const STATUS_SELECT = [
        self::STATUS_NEW => self::STATUS_NEW,
        self::STATUS_ACTIVE => self::STATUS_ACTIVE,
        self::STATUS_REJECTED => self::STATUS_REJECTED,
        self::STATUS_SUSPEND => self::STATUS_SUSPEND,

    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getThemeSwitchIconAttribute(){
        if (Auth::user()->default_theme == 1){
            return 'sun';
        }
        return 'moon';
    }

    public function city(){
        return $this->belongsTo(City::class);
    }


}
