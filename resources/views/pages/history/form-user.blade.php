{!! Form::model($model,[
    'route' => $model->exists ? ['history.update', $model->id]:'history.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'id' => 'form-show'
]) !!}
    @if($array[0]->role == 'Admin')
        <div class="form-group">
          <div class="form-check">
            @if($model->status == 'Accepted')
            {!! Form::radio('status','Accepted',true,['class'=>'form-check-input','id'=>'invalidCheck']) !!}
                <label class="form-check-label" for="status">Accepted</label>
            {!! Form::radio('status','Rejected',['class'=>'form-check-input','id'=>'invalidCheck']) !!}
                <label class="form-check-label" for="status">Rejected</label>
            @elseif($model->status == 'Rejected')
            {!! Form::radio('status','Accepted',['class'=>'form-check-input','id'=>'invalidCheck']) !!}
                <label class="form-check-label" for="status">Accepted</label>
            {!! Form::radio('status','Rejected',true,['class'=>'form-check-input','id'=>'invalidCheck']) !!}
                <label class="form-check-label" for="status">Rejected</label>
            @else
            {!! Form::radio('status','Accepted',['class'=>'form-check-input','id'=>'invalidCheck']) !!}
                <label class="form-check-label" for="status">Accepted</label>
            {!! Form::radio('status','Rejected',['class'=>'form-check-input','id'=>'invalidCheck']) !!}
                <label class="form-check-label" for="status">Rejected</label>
            @endif
            </div>
            <div class="alert" id='message' style='display:none'></div>
        </div>
        {!! Form::hidden('model',$model->id,['class'=>'form-control','id'=>'model']) !!}
        </div>
        <?php $no = 1; ?>
    @foreach ($array[2] as $stocks)
        {!! Form::hidden('products_id[]',$stocks->products_id,['class'=>'form-control','id'=>'products_id']) !!}
        {!! Form::hidden('amount[]',$stocks->amount,['class'=>'form-control','id'=>'amount']) !!}
        <?php $no++ ?>
    @endforeach
        {!! Form::hidden('nomer',$no-1,['class'=>'form-control','id'=>'nomer']) !!}
    @endif
    <div class="form-group">
        {!! Form::hidden('photo',null,['class'=>'form-control','id'=>'photo']) !!}
    </div>
<div class="alert" id='message' style='display:none'></div>
<span id='uploaded_image'></span>
{!! Form::close() !!}
@if($array[0]->role == 'User')
<div class="form-group">
    <label for="" class="control-label">Photo</label>
    <form method="post" id='form-upload' enctype='multipart/form-data'>
    {{csrf_field()}}
        <input type="file" name="select_file" id="select_file">
        <input type="submit" class='btn btn-info' id='upload' name='upload' value='Upload'>
    </form>
</div>

@endif