@extends('athome.layouts.default')

@section('title')
Athome Creation
@stop

@section('main')
<div class="row">
    <h1>Create Athome</h1>
    @include('errors.message')

    {{ Form::open(array('url' => array('athome'), 'method' => 'POST', 'role' => 'form')) }}
    <div class="form-group">
        {{ Form::label('led1', 'Switch 1')}}
        {{ Form::select('led1', array('Close', 'Open'), array('class'=>'selectpicker')) }}
    </div>
    <div class="form-group">
        {{ Form::label('sensor1', 'Sensor 1') }}
        {{ Form::text('sensor1', Request::old('sensor1'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('sensor2', 'Sensor 2') }}
        {{ Form::text('sensor2', Request::old('sensor2'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('temperature', 'Temperature') }}
        {{ Form::text('temperature', Request::old('temperature'), array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Create the Athome!', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@stop
