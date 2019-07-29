<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use App\Detail;
use App\Sell;
use App\Product;
use PDF;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Input;

class HistoryController extends Controller
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
        return view('pages.history.index',compact('user','check'));
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
        $parameter = rand();
        $users_id = $request->users_id;
        $products_id = $request->products_id;
        $products_name = $request->products_name;
        $products_price = $request->products_price;
        $amount = $request->amount;
        $total = $request->total;
        $discount = $request->discount;
        $acuan = $request->nomer;
        for($i = 0; $i <= $acuan; $i++){
            $objModel = new History();
            $objModel->users_id = $users_id[$i];
            $objModel->products_id = $products_id[$i];
            $objModel->products_name = $products_name[$i];
            $objModel->products_price = $products_price[$i];
            $objModel->amount = $amount[$i];
            $objModel->total = $total[$i];
            $objModel->discount = $discount[$i];
            $objModel->parameter = $parameter;
            $objModel->save();
        }
        $user_id = $request->user_id;
        $user_name = $request->user_name;
        $total_price = $request->total_price;
            $tabelSell = new Sell();
            $tabelSell->users_id = $user_id;
            $tabelSell->users_name = $user_name;
            $tabelSell->total_price = $total_price;
            $tabelSell->photo = "";
            $tabelSell->status = "";
            $tabelSell->parameter = $parameter;
            $tabelSell->save();

        Detail::where('users_id',$request->user_id)->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->id;
        $model = History::where('parameter',$id)->where('users_id',$user)->get();
        return view('pages.history.show',compact('model'));
    }
    
    public function print($id)
    {
        $model = History::where('parameter',$id)->get();
        return view('struck',compact('model'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $model = Sell::findOrFail($id);
        $created = $model->parameter;
        $stock = History::where('parameter',$created)->get();
        $jumlah = History::where('users_id',$model->users_id)->where('parameter',$created)->sum('amount');
        $array = [$user,$created,$stock,$jumlah];
        return view('pages.history.form-user',compact('model','array'));
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
        $user = Auth::user();
        if($user->role == 'User'){
            $this->validate($request,[
                'photo'=>'required|string|max:255'
            ]);
            $model = Sell::findOrFail($id);
            $model->update($request->all());
        }
        else if($user->role == 'Admin' ){
            $this->validate($request,[
                'status'=>'required|string|max:255'
            ]);
            $sell = Sell::findOrFail($id);
            $acuan = $request->nomer;
            if($sell->status == "" && $request->status == 'Accepted'){
                for($i = 0 ; $i<$acuan;$i++){
                    $product = Product::findOrFail($request->products_id[$i]);
                    $stock = $product->stock;
                    $sold = $product->sold;
                    $product->update([
                        'stock' => (int)$stock-(int)$request->amount[$i],
                        'sold' => (int)$sold+(int)$request->amount[$i]
                    ]);
                }
            }
            Sell::where('id',$request->model)->update(['status'=> $request->status]);
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
    }
    public function dataTableAdmin()
    {
        $user = Auth::user()->role;
        $model = Sell::query()->orderBy('created_at');
            return DataTables::of($model)
                ->addColumn('action',function($model){
                    return view('layouts._show',[
                        'model'=>$model,
                        'url_show'=>route('history.tampil',['id'=>$model->users_id,'created'=>$model->parameter]),
                        'url_edit'=>route('history.edit',$model->id),
                        'url_print'=>route('history.print',$model->parameter)
                    ]
                );
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
    public function dataTableUser()
    {
        $user = Auth::user()->role;
        $id = Auth::id();
        $model = Sell::where('users_id',$id)->orderBy('created_at')->get();
            return DataTables::of($model)
                ->addColumn('action',function($model){
                    return view('layouts._show-user',[
                        'model'=>$model,
                        'url_show'=>route('history.show',$model->parameter),
                        'url_edit'=>route('history.edit',$model->id)
                    ]
                );
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
    public function tampil($id,$created){
        $model = History::where('parameter',$created)->where('users_id',$id)->get();
        return view('pages.history.show',compact('model'));
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
    public function pdf(){
        $data['all'] = History::leftJoin('sells',
        'histories.parameter', '=', 'sells.parameter')
        ->get();
        $pdf = PDF::loadView('pdf.sell', $data);
        return $pdf->download('Laporan Penjualan.pdf');
    }
}
