{!! Form::model($model,[
    'route' => $model->exists ? ['product.update', $model->id]:'product.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'id' => 'form-show'
]) !!}
    <div class="form-group">
        <label for="" class="control-label">Name</label>
        {!! Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
    </div>
        {!! Form::hidden('sold',0,['class'=>'form-control','id'=>'sold']) !!}
        {!! Form::hidden('user_id',$user->id,['class'=>'form-control','id'=>'user_id']) !!}
    <div class="form-group">
        <label for="" class="control-label">Category</label>
        {!! Form::select("category",[
            'Plastik' => 'Plastik',
            'Kertas' => 'Kertas',
            'Mika' => 'Mika',
            'Gelas' => 'Gelas',
            'Sendok' => 'Sendok',
            ], null,["class" => "form-control", "placeholder" => "Category","id"=>'category']
            )
        !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Price</label>
        {!! Form::number('price',null,['class'=>'form-control','id'=>'price']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Stock</label>
        {!! Form::number('stock',null,['class'=>'form-control','id'=>'stock']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Diskon</label>
        {!! Form::number('discount',null,['class'=>'form-control','id'=>'discount']) !!}
        <small class="text-muted">Diskon dalam bentuk %</small>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Kode Vocher</label>
        {!! Form::text('code',null,['class'=>'form-control','id'=>'code']) !!}
    </div>
    <div class="form-group">
        {!! Form::hidden('photo',null,['class'=>'form-control','id'=>'photo']) !!}
    </div>
    <div class="alert" id='message' style='display:none'></div>
    <span id='uploaded_image'></span>
    {!! Form::close() !!}
    <div class="form-group">
        <label for="" class="control-label">Photo</label>
        <form method="post" id='upload_form' enctype='multipart/form-data'>
        {{csrf_field()}}
            <input type="file" name="select_file" id="select_file">
            <input type="submit" class='btn btn-info' id='upload' name='upload' value='Upload'>
        </form>
    </div>
<script>
$('body').on('keyup','#stock',function(){
    if($(this).val() < 0){
        $('#stock').val(0);
    }
})
$('body').on('keyup','#price',function(){
    if($(this).val() < 0){
        $('#price').val(0);
    }
})
$('body').on('keyup','#discount',function(){
    if($(this).val() < 0){
        $('#discount').val(0);
    }
    else if($(this).val() > 100){
        $('#discount').val(100);
    }
})
</script>