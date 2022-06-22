<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
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

        $sliders = Slider::all();

        return view('dashboard.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $slider=new Slider();
        return view('dashboard.sliders.create',compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SliderRequest $request)
    {

        $requests = $request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }



        $requests['user_id']= Auth::id();
        $slider = Slider::create($requests);

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.sliders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $slider = Slider::findOrFail($id);

        return view('dashboard.sliders.show',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $slider = Slider::findOrFail($id);
        //$slider['name']['ar'] = $sliderModel->getTranslation('name', 'ar');
        return view('dashboard.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, SliderRequest $request)
    {

        $requests=$request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'images');
            $request->files->remove('image');
        }


        $slider = Slider::findOrFail($id);
        $slider->fill($requests)->save();
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.sliders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $slider= Slider::findOrFail($id);
        $slider->delete();
        toast(__('Deleted successfully'),'success');
        return redirect(route('dashboard.sliders.index'));
    }

}
