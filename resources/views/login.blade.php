@extends('layouts.default')

@section('main')
<div class="am-g  am-g-fixed">
    <div class="am-u-lg-6 am-u-md-8">
        <br/>
        @if (Session::has('message'))
            <div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
                <P>{{ Session::get('message')['content'] }}</p>
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="am-alert am-alert-danger" data-am-alert>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif
        <h3> old field {{ Request::old('email') }} </h3>
        {{ Form::open(array('url' => 'login', 'class' => 'am-form')) }}
            {{ Form::label('email', 'E-mail:') }}
            {{ Form::email('email', Request::old('email')) }}
            <br/>
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}
            <br/>
            <label for="remember_me">
                <input id="remember_me" name="remember_me" type="checkbox" value="1">
                Remember Me
            </label>
            <br/>
            <div class="am-cf">
                {{ Form::submit('Login', array('class' => 'am-btn am-btn-primary am-btn-sm am-fl')) }}
            </div>
        {{ Form::close() }}
        <br/>
    </div>
</div>
@stop
