@extends('layouts.default')

@section('main')
<div class="am-g am-g-fixed">
    <div class="am-u-sm-12">
        <h1>Edit Tag</h1>
        <hr/>
        @include('errors.message')
        {{ Form::model($tag, array('url' => URL::route('tag.update', $tag->id), 'method' => 'PUT', 'class' => 'am-form')) }}
            <div class="am-form-group">
                {{ Form::label('name', 'TagName') }}
                {{ Form::text('name', Request::old('name')) }}
            </div>
            <p><button type="submit" class="am-btn am-btn-success">
                    <span class="am-icon-pencil"> Modify</span>
                </button></p>
        {{ Form::close() }}
    </div>
</div>
@stop