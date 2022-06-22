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

    Route::get('nationalities',[NationalityController::class,'index']);
    Route::get('cities',[CityController::class,'index']);
    Route::get('banks',[BankController::class,'index']);

    Route::get('about-us',[HomeController::class,'aboutUs']);
    Route::get('terms',[HomeController::class,'terms']);
    Route::post('contact-us',[ContactUsController::class,'store']);

    Route::get('categories/{type}',[CategoryController::class,'index']);
    Route::get('sub-categories/{id}',[CategoryController::class,'subCategories']);

    Route::get('slider',[HomeController::class,'slider']);


    Route::middleware(['auth:sanctum','lang'])->group(function (){
        Route::post('profile/notification/refresh-notification-token',[NotificationController::class,'refreshToken']);
        Route::get('profile',[ProfileController::class,'index']);
        Route::post('profile',[ProfileController::class,'update']);
        Route::post('profile/update-password',[ProfileController::class,'updatePassword']);
        Route::get('delete-account',[ProfileController::class,'delete']);

        Route::get('orders',[OrderController::class,'index']);
        Route::get('my-orders',[OrderController::class,'myOrders']);
        Route::get('check-coupon',[OrderController::class,'coupon']);

        Route::get('orders/accept',[OrderController::class,'accept']);
        Route::get('orders/reject',[OrderController::class,'reject']);
        Route::post('send-sms',[OrderController::class,'SMS']);
        Route::post('seller-confirm',[OrderController::class,'sellerConfirm']);
        Route::post('client-confirm',[OrderController::class,'clientConfirm']);
        Route::post('rate_order',[OrderController::class,'rateOrder']);

        Route::get('stores',[StoreController::class,'index']);

        Route::get('availability',[ProfileController::class,'availability']);




        Route::get('stores',[StoreController::class,'index']);

        Route::post('stores',[StoreController::class,'store']);



        Route::get('profile/notification',[NotificationController::class,'index']);

        Route::get('profile/notification/change-status',[NotificationController::class,'changeStatus']);

        Route::get('profile/notification/delete',[NotificationController::class,'delete']);

        Route::get('profile/notification/delete-one/{id}',[NotificationController::class,'deleteOne']);


        Route::get('report',[ReportController::class,'index']);

        Route::post('equipments',[EquipmentController::class,'create']);
        Route::get('delete-equipment/{id}',[EquipmentController::class,'delete']);

        Route::get('my-equipments',[EquipmentController::class,'myEquipments']);

        Route::post('orders',[OrderController::class,'store']);
        Route::get('my-orders',[OrderController::class,'myOrders']);
        Route::get('cancel-order',[OrderController::class,'cancel']);
        Route::get('price-order',[OrderController::class,'price']);
        Route::get('accept-price-order',[OrderController::class,'acceptPrice']);

        Route::get('finish-order',[OrderController::class,'finish']);



        Route::get('favourite-equipment/{id}',[EquipmentController::class,'favourite']);
        Route::get('my-favourites',[EquipmentController::class,'myFavourites']);





        //offers provider
        Route::post('offers',[OfferController::class,'store']);
        Route::post('edit-offer',[OfferController::class,'update']);
        Route::get('my-offers',[OfferController::class,'myOffers']);
        Route::get('delete-offer/{id}',[OfferController::class,'delete']);
        Route::get('offer-switch-seen/{id}',[OfferController::class,'switchSeen']);

        Route::get('favourite-offer/{id}',[OfferController::class,'favourite']);
        Route::post('comment-offer/{id}',[OfferController::class,'comment']);

        // =============== Start Chat =============== //
        Route::get('chat/list',[ChatController::class,'index']);
        Route::get('chat/messages/{id}',[ChatController::class,'messages']);
        Route::get('chat/channel/{id}',[ChatController::class,'getChannel']);
        Route::post('chat/messages/send',[ChatController::class,'sendMessage']);
        // =============== End Chat =============== //


        Route::get('home-report',[HomeController::class,'homeWallet']);
        Route::get('wallet',[HomeController::class,'wallet']);
        Route::get('wallet-report',[HomeController::class,'walletReport']);
        Route::get('wallet-report-provider',[HomeController::class,'walletReportProvider']);


    });
    Route::post('stores/status/{id}',[StoreController::class,'status']);

    Route::get('search',[HomeController::class,'search']);





    Route::get('get_city_id',[ProfileController::class,'getCity']);

    Route::post('profile/notification/test-fcm',[NotificationController::class,'testFCM']);



    Route::get('equipments',[EquipmentController::class,'index']);

    Route::get('equipments-list',[EquipmentController::class,'EquipmentsList']);
    Route::get('brands-list',[EquipmentController::class,'brandsList']);

    Route::get('offers',[OfferController::class,'index']);


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
