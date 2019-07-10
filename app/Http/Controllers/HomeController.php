<?php

namespace App\Http\Controllers;

use App\Product;
use Auth;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $model = User::findOrfail($id);
        return view('pages.user.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        $user = Auth::user();
        return view('pages.user.form',compact('model','user'));
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
            'name'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'old_password'=>'required|string|max:255',
            'new_password'=>'required|string|max:255',
            'confirm_password'=>'required|string|max:255',
        ]);
        $model = User::findOrFail($id);
        $oldPassword = $model->password;
        $hash = Hash::check($request->old_password, $oldPassword, []);
        if($hash == true && $request->new_password == $request->confirm_password){
            $model->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->new_password),
                'address'=>$request->address
            ]);   
        }
        else if($hash == true && $request->new_password != $request->confirm_password){
            return response()->json([
                'error' => 'newpassword',
            ]);
        }
        else if($hash == false && $request->new_password == $request->confirm_password){
            return response()->json([
                'error' => 'hash',
            ]);
        }
        else {
            return response()->json([
                'error' => 'double',
            ]);
        }
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
    public function user(){
        $user = Auth::user()['role'];
        $check = Auth::check();
        return view('pages.user.index',compact('user','check'));
    }
    public function dataTable(){
        $user = Auth::user();
        if($user->role == 'User'){
            $model = User::where('id',$user->id)->get();
        }
        else if($user->role == 'Admin'){
            $model = User::query();
        }
            return DataTables::of($model)
                ->addColumn('action',function($model){
                    return view('layouts._show',[
                        'model'=>$model,
                        'url_show'=>route('user.show',$model->id),
                        'url_edit'=>route('user.edit',$model->id)
                    ]
                );
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
}
