<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
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

        $offers = Offer::orderBy('id','desc')->where(function($q)use($request){

            if ($request->has('user_id')  && $request->user_id != '' && $request->user_id != null){
                $q->where('user_id',$request->user_id);
            }
        })->paginate(10);

        return view('dashboard.offers.index', compact('offers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $offer = Offer::findOrFail($id);

        return view('dashboard.offers.show',compact('offer'));
    }



}
