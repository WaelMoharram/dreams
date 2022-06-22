<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Nationality;
use App\Models\Store;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ContactUsController extends Controller
{

    use ApiResponse;


    public function store(Request $request){


         ContactUs::create($request->all());
        return $this->okApiResponse([],__('Message sent'));
    }

}
