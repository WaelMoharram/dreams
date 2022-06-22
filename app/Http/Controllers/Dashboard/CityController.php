<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
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
    public function index()
    {

        $cities = City::paginate(5);

        return view('dashboard.cities.index', compact('cities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $city = City::findOrFail($id);

        return view('dashboard.cities.show',compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $city=new City();
        return view('dashboard.cities.create',compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CityRequest $request)
    {

        //return $request->all();
        $city = City::create($request->all());

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.cities.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $city = City::findOrFail($id);

        return view('dashboard.cities.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, CityRequest $request)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.cities.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $city= City::findOrFail($id);
        $city->delete();
        toast(__('Deleted successfully'),'success');
        return redirect()->back();
    }
}
