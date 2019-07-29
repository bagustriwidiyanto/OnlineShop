<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Detail;
use App\History;
use Auth;
use Session;

class DetailController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'products_id'=>'required|integer',
            'products_name'=>'required|string',
            'products_price'=>'required|integer',
            'amount'=>'required|integer',
            'total'=>'required|integer',
            'users_id'=>'required|integer',
        ]);
        $detail = Detail::create($request->all());
        return $detail;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Product::findOrFail($id);
        $user = Auth::user();
        $cart = Detail::where('products_id',$model->id)->get();
        $history = History::leftJoin('sells','histories.parameter' ,'=', 'sells.parameter')->where('sells.status',"")->get();
        return view('pages.detail.form')->with(compact('model'))->with(compact('user'))->with(compact('cart'))->with(compact('history'));
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
        $model = Detail::findOrFail($id);
        $model->delete();
    }

    public function percobaan()
    {
        $user = Auth::id();
        $detail = Detail::where('users_id', $user)->delete();
        Session::flush();
        return redirect()->route('index');
    }
    public function cart()
    {
        $user = Auth::user();
        $cart = Detail::where('users_id',$user->id)->get();
        return view('cart',compact('cart','user'));
    }
}
