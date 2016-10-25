@extends('athome.layouts.default')

@section('title')
Athome Edition
@stop

@section('main')
<div class="row">
    <h1>Edit {{ $athome->id }}</h1>
    @include('errors.message')

    {{ Form::model($athome, array('route' => array('athome.update', $athome->id), 'method' => 'PUT')) }}
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
    {{ Form::submit('Edit the Athome!', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
<div class="row">
    {{ Form::open(array('url'=>'athome/' . $athome->id, 'method' => 'DELETE', 'id' => 'delete-athome')) }}
    <button type="button" class="btn btn-danger" id="delete{{ $athome->id }}" data-toggle="modal" data-target="#my-confirm"><span class="glyphicon glyphicon-remove"></span> Delete</button>
    {{ Form::close() }}
</div>

<div class="modal fade" tabindex="-1" id="my-confirm" role="dialog" aria-labelledby="MyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="MyModalLabel">Are you sure to delete it</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-warning" id="confirm-delete">Yes</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
   $('#confirm-delete').on('click', function() {
       $('#delete-athome').submit();
    });
});
</script>

@stop
