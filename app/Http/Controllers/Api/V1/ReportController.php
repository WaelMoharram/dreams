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
use App\Models\Nationality;
use App\Models\Store;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{

    use ApiResponse;

    public function index(Request $request)
    {
//TODO one user report
        return $this->okApiResponse([
            'total_profit'=>7000,
            'total_delivery'=>4000,
            'cash_on_delivery'=> 30000,
            'profit_from_sellers'=> 6000
        ], __('report loaded'));
    }
}
