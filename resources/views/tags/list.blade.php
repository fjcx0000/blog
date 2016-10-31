@extends('layouts.default')

@section('main')

    <div class="col-sm-12">
        <h1>All Tags</h1>
        <hr/>
        @foreach($tags as $tag)
            <a href="{{ URL::to('tag/'.$tag->id.'/articles') }}" class="label label-as-badge {{ array('', 'label-primary', 'label-secondary', 'label-success', 'label-warning', 'label-danger')[rand(0,5)] }}">{{ $tag->name }} {{ $tag->count }}</a>
        @endforeach
        <br/>
        <br/>
    </div>

@stop