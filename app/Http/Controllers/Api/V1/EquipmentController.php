<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\EquipmentUserRequest;
use App\Http\Resources\BankResource;
use App\Http\Resources\EquipmentUserResource;
use App\Http\Resources\MainCategoryResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\SelectResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\Bank;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\EquipmentUser;
use App\Models\Favourite;
use App\Models\Offer;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{

    use ApiResponse;

    public function index(Request $request){
       $list =  EquipmentUser::where('for',$request->for)->where(function ($q) use($request){
           if ($request->has('name')){
               $q->where('name','like', '%'.$request->name.'%');
           }
       })->whereHas('equipment',function ($q) use ($request){
           $q->where('category_id',$request->category_id)->orWhereIn('category_id',Category::find($request->category_id)->subs()->get()->pluck('id')->toArray());
       })->paginate(10);
        return $this->okApiResponse(EquipmentUserResource::collection($list),__("Equipments list"));

    }
    public function create(EquipmentUserRequest $request){
        $requests = $request->all();
        if ($request->has('image') && $request->image != null){
            $requests['image'] = $this->saveImage($request->image);
            $request->files->remove('image');
        }
        $requests['user_id']= Auth::id();
        $equipment = EquipmentUser::create($requests);
        return $this->createdApiResponse([],__("Created successfully"));

    }

    public function delete($id) {
        $equipment = EquipmentUser::findOrFail($id);
        $equipment->delete();

        return $this->okApiResponse([],__("Equipment Deleted successfully"));

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

    public function myEquipments(Request $request){
        $list =  EquipmentUser::where('for',$request->for)->where('user_id',Auth::id())->paginate(10);
        return $this->okApiResponse(EquipmentUserResource::collection($list),__("Equipments list"));

    }

    public function EquipmentsList(){
        $equipments =  Equipment::all();
        return $this->okApiResponse(SelectResource::collection($equipments),__("Equipments list"));
    }

    public function brandsList(){
         $brands =  Brand::all();
        return $this->okApiResponse(SelectResource::collection($brands),__("Brands list"));
    }


    public function favourite($id) {
        $equipment = EquipmentUser::findOrFail($id);
        if ($equipment->favourite()->where('user_id',Auth::id())->count() == 0){
            $equipment->favourite()->create(['user_id'=>Auth::id()]);
        }else{
            $equipment->favourite()->where('user_id',Auth::id())->delete();
        }
        return $this->okApiResponse(['is_favourite'=>$equipment->is_favourite],__("Equipment change favourite status successfully"));
    }
    public function myFavourites(Request $request){

        if ($request->type == 'offers'){
            $array2 = Favourite::where('user_id',Auth::id())->where('favourable_type','App\Models\Offer')->pluck('favourable_id')->toArray();
            $offers = Offer::whereIn('id',$array2)->get();

            return $this->okApiResponse(OfferResource::collection($offers),__("Favourites"));
        }else{
            $array = Favourite::where('user_id',Auth::id())->where('favourable_type','App\Models\EquipmentUser')->pluck('favourable_id')->toArray();
            $equipmentUsers = EquipmentUser::whereIn('id',$array)->get();



            return $this->okApiResponse(EquipmentUserResource::collection($equipmentUsers),__("Favourites"));
        }

    }
}
