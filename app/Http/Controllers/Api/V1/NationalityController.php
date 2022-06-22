<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\UserResource;
use App\Models\Nationality;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NationalityController extends Controller
{

    use ApiResponse;

    public function index(){
        $nationalities = Nationality::all();
//        Nationality::create([
//            'name'=>['en'=>'Saudi','ar'=>'سعودى'],
//        ]);
        return $this->okApiResponse(NationalityResource::collection($nationalities),__('Nationalities loaded'));
    }
}
