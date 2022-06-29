<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use ApiResponse;
    public function login(LoginRequest $request)
    {
        $sanitized = $request->validated();

        if ( Auth::attempt($sanitized) ) {
            $AuthedUser = Auth::user();
            $user = Auth::user();

//            if (Auth::user()->is_active == 0){
//                $user->sms_code = 123456;
//                $user->save();
//                return $this->unauthorizedApiResponse(['sms_code' => $user->sms_code],__("Your account need to verify mobile"));
//            }
//
//            if (Auth::user()->is_accepted == 0){
//                $user->sms_code = 123456;
//                $user->save();
//                return $this->unauthorizedApiResponse(['is_accepted'=>0],__("Your account need to activate - please contact us"));
//            }
            $token =$this->generateToken($AuthedUser);
            $AuthedUser->api_token = $token->plainTextToken;
            $AuthedUser->save();
            return $user;
            return $this->okApiResponse(new UserResource($user),__("User information"));

        }
        return $this->notFoundApiResponse(['information'=>0],__('Please check you information'));
    }

    public function register(RegisterRequest $request)
    {
        //return '123';
        $requests = $request->all();
        if (!$request->has('account_type')){
            $requests['account_type']='individual';
        }
        if($request->main_role == 'client'){
            $requests['is_accepted'] = 1;
        }
        $requests['password']  =Hash::make($request->password);
        if ($request->has('image') && $request->image != null){
            $requests['image'] = $this->saveImage($request->image);
            $request->files->remove('image');
        }

        if ($request->has('id_image') && $request->id_image != null){
            $requests['id_image'] = $this->saveImage($request->id_image);
            $request->files->remove('id_image');
        }


        $user = User::create($requests);

        //$user->sms_code = rand(111111,999999);
        $user->sms_code = 123456;

        $token =$this->generateToken($user);
        $user->api_token = $token->plainTextToken;
        $user->save();

        //new SMS($user->mobile,'Your activation code is : '.$user->sms_code);
//        return $this->okApiResponse(new UserResource($user),__("User information"));
        return $this->createdApiResponse(['sms_code' => $user->sms_code],__("Check your mobile"));
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {

        $user = User::where('mobile',request('mobile'))->first();
        if (is_null($user)) {
            return $this->notFoundApiResponse([],__('User not found'));
        }
        //$user->sms_code = rand(111111,999999);
        $user->sms_code = 123456;
        $user->save();
        return $this->okApiResponse(['sms_code' => $user->sms_code],__("Check your mobile"));

    }

    public function codeConfirmSMS(CodeConfirmRequest $request)
    {
        $user = User::where('mobile',$request->mobile)->first();
        if (is_null($user)) {
            return $this->notFoundApiResponse([],__('User not found'));
        }
        if($user->sms_code != $request->sms_code) {
            return $this->badRequestApiResponse(['sms_code invalid'],__('The code is not valid.'));

        }
        $token =$this->generateToken($user);
        $user->api_token        = $token->plainTextToken;
        //$user->sms_code   = rand(111111,999999);
        $user->is_active = 1;
        $user->save();
        return $this->okApiResponse(new UserResource($user),__("User information"));

    }

    public function newPassword(NewPasswordRequest $request)
    {
        $user = User::where('mobile',request('mobile'))->first();
        if (is_null($user)) {
            return $this->notFoundApiResponse([],__('User not found'));
        }
        if($user->sms_code != request('sms_code')) {
            return $this->badRequestApiResponse(['sms_code invalid'],__('The code is not valid.'));

        }
        $requests = $request->all();
        $requests['password'] = Hash::make($request->password);
        $user->update(['password'=>$requests['password']]);
        return $this->okApiResponse(new UserResource($user),__("User information"));

    }

    public function newPhone(NewPhoneRequest $request)
    {
        $user = User::where('mobile',request('old_mobile'))->first();
        if (is_null($user)) {
            return Api::setStatusError()
                ->setMessage(__('User not found'))
                ->build();
        }
        if($user->sms_code != request('code')) {
            return Api::setStatusError()
                ->setMessage(__('The code is not valid.'))
                ->build();
        }
        $requests = $request->all();
        $requests['mobile'] = request('mobile');
        $user->update(['mobile'=>$requests['mobile']]);
        return Api::setStatusOk()
            ->setMessage(__("User information"))
            ->setData(new UserResources($user))
            ->build();
    }

    private function generateToken($user)
    {
        $user->tokens()->delete();
        return $user->createToken("Mobile:token");
    }

    public function testFCM(Request $request){
        $requests = $request->all();
        $FCM = new PushNotifcationChannel();
        $send = $FCM->send(Auth::user(),$requests);
        return $send;
    }

    public function testSMS(Request $request){

//        $SMS = new \Tasawk\SMS\SMS($user->mobile ?? '', __('Confirmation code is :CODE', ['CODE' => $user->sms_code]));
        $SMS = new \Tasawk\SMS\SMS($request->mobile ?? '', $request->message);
        return 'Done';
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

    public function wael(){
        return auth()->user();
    }

}
