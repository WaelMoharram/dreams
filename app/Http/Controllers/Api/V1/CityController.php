<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\Nationality;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{

    use ApiResponse;

    public function index(){

        $city = City::all();

        return $this->okApiResponse(NationalityResource::collection($city),__('Cities loaded'));
    }
}
