<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
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

        $brands = Brand::paginate(5);

        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $brand = Brand::findOrFail($id);

        return view('dashboard.brands.show',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $brand=new Brand();
        return view('dashboard.brands.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BrandRequest $request)
    {


        $brand = Brand::create($request->all());

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.brands.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $brand = Brand::findOrFail($id);

        return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, BrandRequest $request)
    {

        $brand = Brand::findOrFail($id);

        $brand->fill($request->all())->save();
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.brands.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $brand= Brand::findOrFail($id);
        $brand->delete();
        toast(__('Deleted successfully'),'success');
        return redirect()->back();
    }
}
