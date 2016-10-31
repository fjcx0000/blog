@extends('layouts.default')

@section('main')
    <div class="col-lg-6 col-md-8">
        <br/>
        @include('errors.message')

        {{ Form::model($user, array('url' => 'user/'.$user->id, 'method' => 'PUT', 'role' => 'form', 'class' => 'form-horizontal')) }}
        <div class="form-group">
            {{ Form::label('email', 'E-mail:', array('class' => 'col-sm-4 control-label')) }}
            <input id="email" name="email" type="email" readonly="readonly" value="{{ $user->email }}" class="form-control col-sm-offset-4 col-sm-8"/>
        </div>
        <div class="form-group">
            {{Form::label('nickname', 'Nick Name:', array('class' => 'col-sm-4 control-label')) }}
            <input id="nickname" name="nickname" type="text" value="{{{ $user->nickname }}}" class="form-control col-sm-offset-4 col-sm-8"/>
        </div>
        <div class="form-group">
            {{ Form::label('old_password', 'OldPassword:', array('class' => 'col-sm-4 control-label')) }}
            {{ Form::password('old_password',array('class' => 'form-control col-sm-offset-4 col-sm-8')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'NewPassword:', array('class' => 'col-sm-4 control-label')) }}
            {{ Form::password('password',array('class' => 'form-control col-sm-offset-4 col-sm-8')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password_cofirmation', 'ConfirmPassword:', array('class' => 'col-sm-4 control-label')) }}
            {{ Form::password('password_confirmation',array('class' => 'form-control col-sm-offset-4 col-sm-8')) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Modify', array('class' => 'btn btn-primary col-sm-offset-4')) }}
        </div>
        {{ Form::close() }}

    </div>
@stop
