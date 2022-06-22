<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Nationality;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        $users = User::where('main_role',User::ROLE_ADMIN)->orderBy('id','desc')->where(function($q)use($request){

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





        })->paginate(10);
        $cities = City::all()->pluck('name','id');
        return view('dashboard.users.index', compact('users','cities'));
    }

    public function indexArchive(Request $request)
    {

        $users = User::where('main_role',User::ROLE_ADMIN)->onlyTrashed()->orderBy('id','desc')->where(function($q)use($request){

            //Name filter on [first_name,middle_name,last_name]
            if ($request->has('name')  && $request->name != null  && $request->name != ''){
                $q->where('first_name','like', '%'.$request->name.'%')->orWhere('middle_name','like', '%'.$request->name.'%')->orWhere('last_name','like', '%'.$request->name.'%');
            }

            //email filter
            if ($request->has('email')  && $request->email != null  && $request->email != ''){
                $q->where('email','like', '%'.$request->email.'%');
            }

            //status filter
            if ($request->has('status')  && $request->status != null  && $request->status != ''){
                $q->where('status',$request->status);
            }


        })->paginate(10);
        $cities = City::all()->pluck('name','id');
        return view('dashboard.users.index-archive', compact('users','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $user=new User();
        return view('dashboard.users.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        $requests['password']=Hash::make($request->password);
        $requests['status']=User::STATUS_ACTIVE;
        $user = User::create($requests);

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $user = User::findOrFail($id);

        return view('dashboard.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,UserRequest $request)
    {

        $requests=$request->except('role');
        if ($request->hasFile('image')) {

            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }
        if(!is_null($request->password)){
            $requests['password']=Hash::make($request->password);
        }else{
            unset($requests['password']);
        }
        $user = User::find($id);
        $user->fill($requests)->save();
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {

        if ($id == Auth::id()){
            toast(__('Can not delete yourself'),'danger');
            return back();
        }
        $user= User::findOrFail($id);
        $user->delete();
        toast(__('Deleted successfully'),'success');
        return redirect(route('dashboard.users.index'));
    }

    /**
     * Suspend user
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function suspend($id)
    {
        $user = User::findOrFail($id);
        switch ($user->status) {
            case  User::STATUS_ACTIVE;
                $user->update(['status' => User::STATUS_SUSPEND]);
                break;
            case  User::STATUS_SUSPEND;
                $user->update(['status' => User::STATUS_ACTIVE]);
                break;

        }
        toast(__('Status changed successfully'), 'success');
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
        $user= User::findOrFail($id);
        $user->update(['status'=>User::STATUS_ACTIVE]);
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
        $user= User::findOrFail($id);
        $user->update(['status'=>User::STATUS_REJECTED]);
        toast(__('Changed successfully'),'success');
        return redirect()->back();

    }

    /**
     * Switch between dark and light theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchTheme()
    {
        if (Auth::user()->default_theme == 1){
            User::find(Auth::id())->fill(['default_theme'=>0])->save();
        }else{
            User::find(Auth::id())->fill(['default_theme'=>1])->save();
        }

        return back();
    }

    public function restore($id)
    {

        $user = User::withTrashed()->find($id)->restore();
        toast(__('Restored successfully'),'success');
        return redirect(route('dashboard.users.index'));
    }

}

?>
