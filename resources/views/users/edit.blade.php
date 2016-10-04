@extends('layouts.default')

@section('main')
<div class="am-g am-g-fixed">
    <div class="am-u-lg-6 am-u-md-8">
        <br/>
        @include('errors.message')

        {{ Form::model($user, array('url' => 'user/'.$user->id, 'method' => 'PUT', 'class' => 'am-form')) }}
        {{ Form::label('email', 'E-mail:') }}
        <input id="email" name="email" type="email" readonly="readonly" value="{{ $user->email }}" />
        <br/>
        {{Form::label('nickname', 'Nick Name:') }}
        <input id="nickname" name="nickname" type="text" value="{{{ $user->nickname }}}"/>
        <br/>
        {{ Form::label('old_password', 'OldPassword:') }}
        {{ Form::password('old_password') }}
        <br/>
        {{ Form::label('password', 'NewPassword:') }}
        {{ Form::password('password') }}
        <br/>
        {{ Form::label('password_cofirmation', 'ConfirmPassword:') }}
        {{ Form::password('password_confirmation') }}
        <br/>
        <div class="am-cf">
            {{ Form::submit('Modify', array('class' => 'am-btn am-btn-primary am-btn-sm am-fl')) }}
        </div>
        {{ Form::close() }}
        <br/>
    </div>
</div>
@stop
