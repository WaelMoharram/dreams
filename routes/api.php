<?php

use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\OfferController;
use App\Http\Controllers\Api\V1\NationalityController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\BankController;
use App\Http\Controllers\Api\V1\StoreController;
use App\Http\Controllers\Api\V1\ContactUsController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\EquipmentController;
use App\Http\Controllers\Api\V1\ChatController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
class apiResponse {
    use \App\Traits\ApiResponse;
}
Route::prefix('v1')->middleware('lang')->group(function (){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('forget-password',[AuthController::class,'forgetPassword']);
    Route::post('code-confirm',[AuthController::class,'codeConfirmSMS']);
    Route::post('new-password',[AuthController::class,'newPassword']);
    Route::get('wael',[AuthController::class,'wael']);


    Route::get('settings',[HomeController::class,'settings']);


    Route::get('about-us',[HomeController::class,'aboutUs']);
    Route::get('terms',[HomeController::class,'terms']);
    Route::post('contact-us',[ContactUsController::class,'store']);




    Route::middleware(['auth:sanctum','lang'])->group(function (){
        Route::post('profile/notification/refresh-notification-token',[NotificationController::class,'refreshToken']);
        Route::get('profile',[ProfileController::class,'index']);
        Route::post('profile',[ProfileController::class,'update']);
        Route::post('profile/update-password',[ProfileController::class,'updatePassword']);
        Route::get('delete-account',[ProfileController::class,'delete']);

        Route::get('profile/notification',[NotificationController::class,'index']);

        Route::get('profile/notification/change-status',[NotificationController::class,'changeStatus']);

        Route::get('profile/notification/delete',[NotificationController::class,'delete']);

        Route::get('profile/notification/delete-one/{id}',[NotificationController::class,'deleteOne']);


    });
    Route::post('stores/status/{id}',[StoreController::class,'status']);

    Route::get('search',[HomeController::class,'search']);






});


Route::get('payment/{type}/{order_id}', function ($type,$order_id) {
    $types = [
        "success",
        "error"
    ];
    $r =new apiResponse();
    if ($type == "success"){
        $order = \App\Models\Order::find($order_id);
        $order->fill(['status'=>\App\Models\Order::STATUS_WORKING])->save();

        $tokens =Token::whereIn('user_id',[$order->user_id,$order->provider_id])->pluck('token');
        firebase_notification('Order Paid','Order NO. '.$order->id.' paid',$tokens,'');
        return $r->okApiResponse([],__('Payment done successfully'));


    }
    return $r->badRequestApiResponse(['payment Not done'],__('payment Not done.'));


})->name('payment_redirect');

Route::middleware(['auth:sanctum','lang'])->get('/user', function (Request $request) {
    return $request->user();
});
