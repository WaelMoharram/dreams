<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Notification;
use App\Models\Token;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    use ApiResponse;

    public function index() {
        $data = Notification::where('notifiable_type','App\Models\User')->where('notifiable_id',auth()->id())->get();

        return $this->okApiResponse($data,__('Notification loaded'));

    }

    public function delete() {
        Notification::where('notifiable_type','App\Models\User')->where('notifiable_id',auth()->id())->delete();
        return $this->okApiResponse([],__("All notification deleted"));
    }

    public function deleteOne($id) {
        Notification::find($id)->delete();
        return $this->okApiResponse([],__("Notification deleted"));
    }

    public function refreshToken(Request $request) {
        if (!$request->has("device_token")) {
            return $this->notFoundApiResponse([],__('Device token is required'));

        }
        Token::create([
            'user_id' => Auth::id() ,
            'token' => $request->device_token
        ]);
        return $this->okApiResponse(['token' => $request->device_token,'id'=>Auth::id()],__("Token updated"));

    }

    public function changeStatus() {
        $notificationStatus = Auth::user()->notification_status;

        Auth::user()->update([
                'notification_status'=> ($notificationStatus) ? 0 : 1
            ]);

        return $this->okApiResponse(new UserResource(\Auth::user()),__("Notification has been changed"));

    }

    public function testFCM(Request $request){
        $requests = $request->all();
        $tokens =[$request->device_token];
        return firebase_notification('Test','Test',$tokens,'',[]);

//        $FCM = new PushNotifcationChannel();
//        $send = $FCM->send(Auth::user(),$requests);
//        return $send;
    }
}
