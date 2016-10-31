@extends('layouts.default')

@section('main')
    <div class="col-sm-12">
        <br/>
        <blockquote>Tag: <span class="label label-success label-as-badge">{{ $tag->name }}</span></blockquote>
        @foreach($articles as $article)
        <article>
            <h3>
                <a href="{{ URL::route('article.show', $article->id) }}">{{ $article->title }}</a>
            </h3>
            <h4>
                by <a href="{{ URL::to('user/'.$article->id.'/articles') }}">{{ $article->user->nickname }}</a> posted on {{ $article->created_at->format('Y/m/d H:i') }} under
                @foreach($article->tags as $tag)
                    <a href="{{ URL::to('tag/'.$tag->id.'/articles') }}" style="color: #fff;" class="label label-success label-as-badge">{{ $tag->name }}</a>
                @endforeach
            </h4>
            <div class="row">
                <div class="col-sm-12">
                    @if ($article->summary)
                        <p>{{ $article->summary }}</p>
                    @endif
                    <hr/>
                </div>
            </div>
        </article>
        @endforeach
    </div>
@stop