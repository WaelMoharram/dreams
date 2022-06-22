<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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

        $orders = Order::orderBy('id','desc')->where(function($q)use($request){
            if ($request->has('status')  && $request->status != '' && $request->status != null){
                $q->where('status',$request->status);
            }
            if ($request->has('user_id')  && $request->user_id != '' && $request->user_id != null){
                $q->where('user_id',$request->user_id);
            }
        })->paginate(10);

        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $order = Order::findOrFail($id);

        return view('dashboard.orders.show',compact('order'));
    }



}
