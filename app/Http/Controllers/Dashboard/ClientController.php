<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $clients = User::where('main_role',User::ROLE_CLIENT)->orderBy('id','desc')->where(function($q)use($request){

            //Name filter on [name,middle_name,last_name]
            if ($request->has('name')  && $request->name != null  && $request->name != ''){
                $q->where('name','like', '%'.$request->name.'%');
            }

            //email filter
            if ($request->has('email')  && $request->email != null  && $request->email != ''){
                $q->where('email','like', '%'.$request->email.'%');
            }

            //status filter
            if ($request->has('status')  && $request->status != null  && $request->status != ''){
                $q->where('status',$request->status);
            }

            //phone filter
            if ($request->has('phone')  && $request->phone != null  && $request->phone != ''){
                $q->where('phone','like', '%'.$request->phone.'%');
            }

            //city filter
            if ($request->has('city_id')  && $request->city_id != null  && $request->city_id != ''){
                $q->where('city_id',$request->city_id);
            }


        })->paginate(10);
        $cities = City::all()->pluck('name','id');
        return view('dashboard.clients.index', compact('clients','cities'));
    }

    public function indexArchive(Request $request)
    {

        $clients = User::where('main_role',User::ROLE_CLIENT)->onlyTrashed()->orderBy('id','desc')->where(function($q)use($request){

            //Name filter on [name,middle_name,last_name]
            if ($request->has('name')  && $request->name != null  && $request->name != ''){
                $q->where('name','like', '%'.$request->name.'%')->orWhere('name','like', '%'.$request->name.'%');
            }

            //email filter
            if ($request->has('email')  && $request->email != null  && $request->email != ''){
                $q->where('email','like', '%'.$request->email.'%');
            }



            //phone filter
            if ($request->has('phone')  && $request->phone != null  && $request->phone != ''){
                $q->where('phone','like', '%'.$request->phone.'%');
            }

            //city filter
            if ($request->has('city_id')  && $request->city_id != null  && $request->city_id != ''){
                $q->where('city_id',$request->city_id);
            }


        })->paginate(10);
        $cities = City::all()->pluck('name','id');
        return view('dashboard.clients.index-archive', compact('clients','cities'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $client=new User();
        return view('dashboard.clients.create',compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ClientRequest $request)
    {
        $requests= $request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        if ($request->hasFile('id_image')) {
            $requests['id_image'] = saveImage($request->id_image, 'images');
            $request->files->remove('id_image');
        }
        $requests['status']=User::STATUS_ACTIVE;
        $requests['main_role']=User::ROLE_CLIENT;
        $requests['password']=Hash::make($request->password);
        $client = User::create($requests);

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $client = User::findOrFail($id);

        return view('dashboard.clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $client = User::findOrFail($id);

        return view('dashboard.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,ClientRequest $request)
    {

        $requests=$request->all();

        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        if ($request->hasFile('id_image')) {

            $requests['id_image'] = saveImage($request->id_image, 'images');
            $request->files->remove('id_image');
        }
        if(!is_null($request->password)){
            $requests['password']=Hash::make($request->password);
        }else{
            unset($requests['password']);
        }
        $client = User::find($id);
        $client->fill($requests)->save();
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $client= User::findOrFail($id);
        $client->delete();
        toast(__('Deleted successfully'),'success');
        return redirect(route('dashboard.clients.index'));
    }



    /**
     * Suspend user
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function suspend($id)
    {
        $user= User::findOrFail($id);
        switch ($user->status) {
            case  User::STATUS_ACTIVE;
                $user->update(['status'=>User::STATUS_SUSPEND]);
    break;
            case  User::STATUS_SUSPEND;
                $user->update(['status'=>User::STATUS_ACTIVE]);
    break;

        }
        toast(__('Status changed successfully'),'success');
        return redirect()->back();

    }

    /**
     * Approve user
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function approve($id)
    {
        $client= User::findOrFail($id);
        $client->update(['status'=>User::STATUS_ACTIVE]);
        toast(__('Changed successfully'),'success');
        return redirect()->back();

    }

    /**
     * Disapprove user
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function disapprove($id)
    {
        $client= User::findOrFail($id);
        $client->update(['status'=>User::STATUS_REJECTED]);
        toast(__('Changed successfully'),'success');
        return redirect()->back();

    }


    /**
     * Restore user
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore($id)
    {

        $user = User::withTrashed()->find($id)->restore();
        toast(__('Restored successfully'),'success');
        return redirect(route('dashboard.clients.index'));
    }

}

?>
