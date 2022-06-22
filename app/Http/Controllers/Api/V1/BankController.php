<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Resources\BankResource;
use App\Models\Bank;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BankController extends Controller
{

    use ApiResponse;

    public function index(){
//        Bank::create([
//            'name'=>['en'=>'AlexBank','ar'=>'بنك الاسكندرية'],
//        ]);

        $bank = Bank::all();

        return $this->okApiResponse(BankResource::collection($bank),__('Banks loaded'));
    }
}
