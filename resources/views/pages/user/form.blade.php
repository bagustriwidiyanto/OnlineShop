{!! Form::model($model,[
    'route' => $model->exists ? ['user.update', $model->id]:'user.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'id' => 'form-show'
]) !!}
    <div class="form-group">
        <label for="" class="control-label">Name</label>
        {!! Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Phone</label>
        {!! Form::number('phone',null,['class'=>'form-control','id'=>'phone']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Address</label>
        {!! Form::text('address',null,['class'=>'form-control','id'=>'address']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Old Password</label>
        {!! Form::password('old_password',['class'=>'form-control','id'=>'old_password']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">New Password</label>
        {!! Form::password('new_password',['class'=>'form-control','id'=>'new_password']) !!}
    </div>
    <div class="form-group">
        <label for="" class="control-label">Confirm New Password</label>
        {!! Form::password('confirm_password',['class'=>'form-control','id'=>'confirm_password']) !!}
    </div>
    {!! Form::close() !!}