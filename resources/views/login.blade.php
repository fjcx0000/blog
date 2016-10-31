@extends('layouts.default')

@section('main')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <br/>
        @include('errors.message')

        <h3> Login </h3>
        {{ Form::open(array('url' => 'login')) }}
            <div class="form-group">
            {{ Form::label('email', 'E-mail:') }}
            {{ Form::email('email', Request::old('email'),array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
            </div>
            <div class="form-group">
            <label for="remember_me">
                <input id="remember_me" name="remember_me" type="checkbox" value="1">
                Remember Me
            </label>
            </div>
            <div class="form-group">
                {{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
            </div>
        {{ Form::close() }}
        <br/>
    </div>
</div>
@stop
