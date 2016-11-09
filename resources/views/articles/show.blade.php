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
                    <p>{{ $article->resolved_content }}</p>
                </div>
            </div>
            @if ($article->comments->count() > 0)
                <div class="panel">
                    <div class="panel-heading">
                        <h3>Comments <span class="badge">{{ $article->comments->count() }}</span></h3>
                    </div>
                    <div class="panel-body">

                        <ul>
                            @foreach($article->comments as $comment)
                                <li>
                                    <h4>{{ $comment->user->nickname }} <small> on {{$comment->created_at}}</small></h4>
                                    <p>{{ $comment->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div>
                {{ Form::open(array('url' => 'comment', 'class' => 'form-horizontal', 'role' => 'form')) }}
                <input type="hidden" name="article_id" value="{{ $article->id }}"/>
                <div class="form-group">
                    {{ Form::label('content', 'New Comment:', array('class' => 'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::textarea('content',null, array('class' => 'form-control', 'rows' => 3)) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {{ Form::submit('Submit', array('class' => 'btn btn-primarty')) }}
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </div>

@stop
