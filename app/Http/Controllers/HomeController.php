<?php

namespace App\Http\Controllers;

use App\Product;
use Auth;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $check = Auth::check();
        $user = Auth::user()['role'];
        $product = Product::orderBy('sold')->where('stock','>',0)->paginate(6);
        return view('index',compact('product','check','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function tampil($id)
    {
        $model = Product::findOrfail($id);
        return view('show',compact('model'));
    }
    public function category($id){
        $check = Auth::check();
        $user = Auth::user()['role'];
        $category = Product::where('category',$id)->where('stock','>',0)->paginate(16);
        return view('category',compact('category','check','user','id'));
    }
    public function diskon($id,$diskon){
        $check = Auth::check();
        $user = Auth::user()['role'];
        $category = Product::where('category',$id)->where('discount',$diskon)->where('stock','>',0)->paginate(16);
        return view('category',compact('category','check','user','id'));
    }   
}
