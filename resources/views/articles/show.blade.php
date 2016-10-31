@extends('layouts.default')

@section('main')


        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>{{{ $article->title }}}</h3>
                    <p>Author: <a href="{{ URL::to('user/'.$article->user->id.'/articles') }}" style="cursor: pointer;">{{{ $article->user->nickname }}}</a> Datetime: {{ $article->updated_at }}</p>
                </div>
                <div class="panel-body">
                    <blockquote>
                      Tags:
                      @foreach ($article->tags as $tag)
                            <a class="label label-success label-as-badge">{{ $tag->name }}</a>
                      @endforeach
                    </blockquote>
                    <p>{!! $article->resolved_content !!}</p>
                </div>
            </div>
        </div>


@stop
