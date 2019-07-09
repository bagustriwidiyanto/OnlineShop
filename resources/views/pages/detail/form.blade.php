{!! Form::model($model,[
    'route' => 'detail.store',
    'method' => 'POST',
    'id' => 'form-show'
]) !!}
<div class="form-group">
    <label for="" class="control-label">Jumlah</label>
    {!! Form::number('amount',null,['class'=>'form-control','id'=>'amount']) !!}
    @if($model->discount != null)
    <br><label for="#discount-code" class="control-label">Kode Diskon</label>
    {!! Form::text('discountcode',null,['class'=>'form-control col-12','id'=>'discountcode']) !!}
    {!! Form::hidden('',$model->discount,['class'=>'form-control','id'=>'discount']) !!}
    {!! Form::hidden('',base64_encode($model->code),['class'=>'form-control col-12','id'=>'___token']) !!}
    <div class='col-2'><a class='diskon' href="#">Check Diskon</a></div>
    <div class='float-right'><small>Barang ini memiliki diskon sampai dengan {{$model->discount}}%</small></div>
    @endif
    <span id='tempat'></span>
    {!! Form::hidden('products_id',$model->id,['class'=>'form-control','id'=>'products_id']) !!}
    {!! Form::hidden('products_name',$model->name,['class'=>'form-control','id'=>'products_name']) !!}
    {!! Form::hidden('products_price',$model->price,['class'=>'form-control','id'=>'products_price']) !!}
    {!! Form::hidden('total',0,['class'=>'form-control','id'=>'total']) !!}
    {!! Form::hidden('users_id',$user->id,['class'=>'form-control','id'=>'users_id']) !!}
    {!! Form::hidden('stock',$model->stock,['class'=>'form-control','id'=>'stock']) !!}
{!! Form::close() !!}
</div>