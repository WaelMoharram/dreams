<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Resources\ChatMessageResources;
use App\Http\Resources\ChatResources;
use App\Models\ChatChannel;
use App\Models\ChatMessage;
use App\Models\Token;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller {

    use ApiResponse;

    public function index() {
        if (Auth::user()->main_role =='client') {
            $chatList = ChatChannel::whereHas('messages')->where('user_id', auth()->id())->paginate();
        }else{
            $chatList = ChatChannel::whereHas('messages')->where('provider_id', auth()->id())->paginate();

        }
        return $this->okApiResponse(ChatResources::collection($chatList)->response()->getData(true),__('Chat list'));

    }

    public function messages($id){
        $list = ChatMessage::without(['services','branches','days'])->where('channel_id',$id)->orderByDesc('id')->paginate();

        return $this->okApiResponse(ChatMessageResources::collection($list)->response()->getData(true),__('Messages list'));

    }

    public function sendMessage(Request $request){
        $channel = ChatChannel::find($request->channel_id);
        $request_image = '';
        $tokens='';
        $from_id='';
        $to_id ='';
        if ($request->has('image') && $request->image != null){
            $request_image = $this->saveImage($request->image);
            $request->files->remove('image');
        }
        if (Auth::user()->main_role =='client') {
            $from_id=auth()->id();
            $to_id = $channel->provider_id;
            ChatMessage::create([
                'channel_id' => $request->channel_id,
                'from_id' => $from_id,
                'to_id' => $to_id,
                'message' => ($request->message ?? ''),
                'image' => $request_image
            ]);
            $tokens = Token::where('user_id',$channel->provider_id)->pluck('token')->toArray();
        }else{
            $from_id=Auth::id();
            $to_id = $channel->user_id;
            ChatMessage::create([
                'channel_id' => $request->channel_id,
                'from_id' => $from_id,
                'to_id' => $to_id,
                'message' => ($request->message ?? ''),
                'image' => $request_image
            ]);
            $tokens = Token::where('user_id',$to_id)->pluck('token')->toArray();
        }
        $firebase = firebase_chat_notification('Chat',$request->message,$tokens,'FLUTTER_NOTIFICATION_CLICK',[
            'title' => 'chat',
            'message' => $request->message,
            'is_chat' => 1 ?? 0,
            'from_id' => $from_id ?? 0,
            'to_id' => $to_id ?? 0,
            'channel_id' => $request->channel_id ?? 0,
            'image' => $request_image,
        ]);
//        $firebase = (new Firebase())
//            ->setTitle('Chat')
//            ->setBody($request->message)
//            ->setClickAction("FLUTTER_NOTIFICATION_CLICK")
//            ->setMoreData([
//                'title' => 'chat',
//                'message' => $request->message,
//                'is_chat' => 1 ?? 0,
//                'from_id' => $from_id ?? 0,
//                'to_id' => $to_id ?? 0,
//                'channel_id' => $request->channel_id ?? 0,
//                'image' => $request_image,
//            ])
//            ->setAuthorizationKey(env('FCM_API_ACCESS_KEY'))
//            ->setTokens($tokens)->do();
        return $this->okApiResponse([$firebase],__('Send successfully'));

    }

    public function getChannel($id){

        if (Auth::user()->main_role =='client'){
            $channel = ChatChannel::where('user_id',auth()->id())->where('provider_id',$id)->first();

            if (!$channel){
                $channel = ChatChannel::create(['user_id'=>auth()->id(),'provider_id'=>$id]);
            }
        }else{
            $channel = ChatChannel::where('provider_id',auth()->id())->where('user_id',$id)->first();

            if (!$channel){
                $channel = ChatChannel::create(['provider_id'=>auth()->id(),'user_id'=>$id]);
            }
        }

        return $this->okApiResponse(new ChatResources($channel),__('Send successfully'));

    }

    function saveImage($file, $folder = '/')
    {
        request()->files->remove('link');

        $fileName = time() . rand(10,99).$file->getClientOriginalName();
        $dest = public_path('/uploads/' . $folder);
        $file->move($dest, $fileName);

        $uploaded_file = 'uploads/' . $folder . '/' . $fileName;
        return $uploaded_file;
    }
}


