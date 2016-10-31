@extends('layouts.default')

@section('main')

    <div class="col-lg-6 col-md-8">
        @include('errors.message')


        {{ Form::open(array('url' => 'register', 'class' => 'form-horizontal', 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('email', 'E-mail:', array('class' => 'col-sm-4 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::email('email', Request::old('email'), array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('name', 'Name:', array('class' => 'col-sm-4 control-label')) }}
                <div class="col-sm-8">
                   {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('nickname', 'NickName:', array('class' => 'col-sm-4 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('nickname', Request::old('nickname'), array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Password:', array('class' => 'col-sm-4 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::password('password', array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirm Password:', array('class' => 'col-sm-4 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    {{ Form::submit('Register', array('class' => 'btn btn-primarty')) }}
                </div>
            </div>
        {{ Form::close() }}
    </div>
@stop

