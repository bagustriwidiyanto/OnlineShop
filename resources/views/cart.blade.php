{!! Form::open([
    'route' => 'history.store',
    'method' => 'POST',
    'id' => 'form-cart-save',
]) !!}
<?php $no = 1; ?>
    @foreach($cart as $carts)
        {!! Form::hidden('users_id[]',$user->id,['class'=>'form-control','id'=>'users_id'.$no]) !!}
        {!! Form::hidden('products_id[]',$carts->products_id,['class'=>'form-control','id'=>'products_id'.$no])!!}
        {!! Form::hidden('products_name[]',$carts->products_name,['class'=>'form-control','id'=>'products_name'.$no])!!}
        {!! Form::hidden('products_price[]',$carts->products_price,['class'=>'form-control','id'=>'products_price'.$no])!!}
        {!! Form::hidden('amount[]',$carts->amount,['class'=>'form-control','id'=>'amount'.$no])!!}
        {!! Form::hidden('total[]',$carts->total,['class'=>'form-control','id'=>'total'.$no])!!}
        {!! Form::hidden('discount[]',$carts->products_price * $carts->amount - $carts->total,['class'=>'form-control','id'=>'discount'.$no++])!!}
    @endforeach
    {!! Form::hidden('user_id',$user->id,['class'=>'form-control','id'=>'users_id']) !!}
    {!! Form::hidden('user_name',$user->name,['class'=>'form-control','id'=>'users_name']) !!}
    {!! Form::hidden('total_price',$carts->sum('total'),['class'=>'form-control','id'=>'total_price']) !!}
    {!! Form::hidden('nomer',$no-2,['class'=>'form-control','id'=>'nomer'])!!}
    {!! Form::close() !!}
<div class="container" id='cart-form-load'>
    @foreach($cart as $carts)
    <div class="alert alert-info">
        <button type="button" href='{{route("detail.destroy",$carts->id)}}' aria-hidden="true" class="close btn-delete-cart">
            <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <span><b> {{$carts->products_name}}    :   </b> Rp {{$carts->products_price}} x {{$carts->amount}} = Rp {{$carts->total}} | Diskon = {{$carts->products_price * $carts->amount - $carts->total}}  </span>
    </div>
    @endforeach
    <div class="alert alert-danger float-right col-md-6 col-sm-9 col-lg-3">
        <span><b> Total : {{$carts->sum('total')}}   </b></span>
    </div>
</div>