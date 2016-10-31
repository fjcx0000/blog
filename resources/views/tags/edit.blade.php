@extends('layouts.default')

@section('main')

    <div class="col-sm-12">
        <h1>Edit Tag</h1>
        <hr/>
        @include('errors.message')
        {{ Form::model($tag, array('url' => URL::route('tag.update', $tag->id), 'method' => 'PUT', 'role' => 'form')) }}
            <div class="form-group">
                {{ Form::label('name', 'TagName') }}
                {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-pencil"> Modify</span>
                </button>
            </div>
        {{ Form::close() }}
    </div>

@stop