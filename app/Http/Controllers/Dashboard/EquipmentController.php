<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
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

        $equipments = Equipment::paginate(5);

        return view('dashboard.equipments.index', compact('equipments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $equipment = Equipment::findOrFail($id);

        return view('dashboard.equipments.show',compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $equipment=new Equipment();
        return view('dashboard.equipments.create',compact('equipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(EquipmentRequest $request)
    {


        $equipment = Equipment::create($request->all());

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.equipments.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $equipment = Equipment::findOrFail($id);

        return view('dashboard.equipments.edit',compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, EquipmentRequest $request)
    {

        $equipment = Equipment::findOrFail($id);

        $equipment->fill($request->all())->save();
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.equipments.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $equipment= Equipment::findOrFail($id);
        $equipment->delete();
        toast(__('Deleted successfully'),'success');
        return redirect()->back();
    }
}
