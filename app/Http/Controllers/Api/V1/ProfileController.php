<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\LocationResource;
use App\Http\Resources\UserResource;
use App\Models\City;
use App\Models\Order;
use App\Models\User;
use App\Models\UserChange;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->okApiResponse(new UserResource(Auth::user()),__("User information"));
    }

    public function update(ProfileRequest $request) {
        $user = Auth::user();
        $requests = $request->all();
//        $requests['user_id'] = Auth::id();
        //unset($requests['city_id']);
        if(request()->has('password')) {
            unset($requests['password']);
        }


        if ($request->has('image') && $request->image != null){
            $requests['image'] = $this->saveImage($request->image);
            $request->files->remove('image');
        }

        if ($request->has('id_image') && $request->id_image != null){
            $requests['id_image'] = $this->saveImage($request->id_image);
            $request->files->remove('id_image');
        }

        User::find(Auth::id())->fill($requests)->save();
        if ($request->has('mobile')){
            if ($user->mobile != $request->mobile) {
                //$user->sms_code = rand(111111,999999);
                $user->sms_code = 123456;
                $user->is_active = 0;
                $user->save();
                return $this->unauthorizedApiResponse(['sms_code' => $user->sms_code],__("Check your mobile"));

            }
        }
//        if (UserChange::where('user_id',Auth::id())->first()){
//            UserChange::where('user_id',Auth::id())->delete();
//        }
//        UserChange::create($requests);

        // $user->update($requests);
        return $this->okApiResponse([],__("Profile updated"));

    }

    public function updatePassword(PasswordUpdateRequest $request) {
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return $this->badRequestApiResponse(['password invalid'],__('Your password incorrect.'));

        }
        $request->merge(['password'=>Hash::make($request->password)]);
        $user->update($request->all());
        return $this->okApiResponse(new UserResource($user),__("User information"));

    }

    public function delete() {
        $user = Auth::user();
        $user->delete();

        return $this->okApiResponse([],__("User Deleted successfully"));

    }

    public function availability(){
        if (Order::where('user_id',Auth::id())->where('status','new')->count() > 0){
            return $this->badRequestApiResponse(['User has new active orders need action'],__('You have new active orders need action.'));
        }
        $user = Auth::user();
        if ($user->availability == 1){
            $user->availability = 0;
            $user->save();
        }else{
            $user->availability = 1;
            $user->save();
        }
        return $this->okApiResponse(new UserResource($user),__("User Availability updated successfully"));
    }
    public function getCity()
    {
        if (request()->input('lat') == NULL || request()->input('lng') == '') {
            return $this->badRequestApiResponse(['Please check lat lng'],__('Please check lat lng.'));
        }
        $lat=request()->input('lat');
        $lng=request()->input('lng');
        $cities = City::all();
        foreach ($cities as $city){
//            if ($city->boundaries == "{}"){
//                return Api::setStatusOk()
//                    ->setMessage(__('No city'))
//                    ->build();
//            }
            $pinsCheck = json_decode($city->boundaries)->features[0]->geometry->coordinates[0];
            $pins='';
            foreach ($pinsCheck as $pin){
                $pins .="".$pin[0]." ".$pin[1].", ";
            }

            $pins .= $pinsCheck[0][0] . " " . $pinsCheck[0][1];
            $query="ST_Within(ST_GEOMFROMTEXT('POINT(".$lng." ".$lat.")'),
        ST_GEOMFROMTEXT('POLYGON((".$pins."))'))";


            $area = City::select('*')->whereRaw("{$query} = ?", 1)->first();
            if ($area){
                return $this->okApiResponse(new LocationResource($city),__("City id"));


            }


        }
        return $this->okApiResponse([],__("No city"));


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
