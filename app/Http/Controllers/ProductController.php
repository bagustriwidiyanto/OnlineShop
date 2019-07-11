<?php

namespace App\Http\Controllers;

use App\Product;
use DataTables;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user()['role'];
        $check = Auth::check();
        return view('pages.product.index',compact('user','check'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Product();
        $user = Auth::user();
        return view('pages.product.form',compact('model','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->kd_disc == null){
            $request->kd_disc = "";
        }
        // dd($request->code);
        $this->validate($request,[
            'user_id'=>'required|integer',
            'name'=>'required|string|max:255',
            'category'=>'required|string|max:255',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'sold'=>'required|integer',
            'photo'=>'required|string|max:255',        
            ]);
        Product::insert([
            'user_id'=> $request->user_id,
            'name'=>$request->name,
            'category'=>$request->category,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'sold'=>$request->sold,
            'photo'=>$request->photo,
            'discount'=>$request->discount,
            'code'=>$request->kd_disc,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Product::findOrfail($id);
        return view('pages.product.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Product::findOrFail($id);
        $user = Auth::user();
        return view('pages.product.form',compact('model','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'user_id'=>'required|integer',
            'name'=>'required|string|max:255',
            'category'=>'required|string|max:255',
            'price'=>'required|integer',
            'stock'=>'required|integer|min:1',
            'sold'=>'required|integer',
            'photo'=>'required|string|max:255',
            'discount'=>'max:255',
            'code' => 'string|max:255'
        ]);
        $model = Product::findOrFail($id);
        $model->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Product::findOrFail($id);
        $model->delete();
    }
    public function dataTable()
    {
        $model = Product::query();
            return DataTables::of($model)
                ->addColumn('action',function($model){
                    return view('layouts._action',[
                        'model'=>$model,
                        'url_show'=>route('product.show',$model->id),
                        'url_edit'=>route('product.edit',$model->id),
                        'url_destroy'=>route('product.destroy',$model->id)
                    ]
                );
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
    public function action(Request $request){
        $validation = Validator::make($request->all(),[
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($validation->passes())
        {
            $image = $request->file('select_file');
            $new_name = rand() .'.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'),$new_name);
            return response()->json([
                'message' => 'Success Upload Image !',
                'upload_image' => '<img src="/images/'.$new_name.'" id="image" name="image" width="300"/>',
                'input' => $new_name,
                'class_name'    => 'alert alert-success'
            ]);
        }
        else{
            return response()->json([
                'message' => $validation->errors()->all(),
                'upload_image' => "",
                'class_name'    => 'alert-danger'
            ]);
        }
    }
    public function diskon(){
        $user = Auth::user()['role'];
        $check = Auth::check();
        return view('diskon',compact('user','check'));
    }
    public function diskonUpdate(Request $request){
        $diskon = Product::where('category',$request->category);
        $diskon->update([
            'discount'=>$request->discount,
            'code'=>$request->code
        ]);
    }
}