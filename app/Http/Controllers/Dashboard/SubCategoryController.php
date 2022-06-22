<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
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

        $categories = Category::where('upper_id',$request->id)->paginate(50);

        return view('dashboard.sub-categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $category = Category::findOrFail($id);

        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $category=new Category();
        return view('dashboard.sub-categories.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
$upper = Category::find($request->category_id);

        $requests = $request->all();
        $requests['upper_id'] = $upper->id;
        $requests['image'] = $upper->image;
        $requests['is_rent'] = $upper->is_rent;
        $requests['is_sell'] = $upper->is_sell;
        $requests['is_transportation'] = $upper->is_transportation;

        $category = Category::create($requests);

        toast(__('Added successfully'),'success');
        return redirect(route('dashboard.categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        $category = Category::findOrFail($id);

        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, CategoryRequest $request)
    {

        $category = Category::findOrFail($id);
        $requests = $request->all();
        $category->fill($requests)->save();
        toast(__('Edited successfully'),'success');
        return redirect(route('dashboard.categories.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $category= Category::findOrFail($id);
        $category->delete();
        toast(__('Deleted successfully'),'success');
        return redirect()->back();
    }
}
