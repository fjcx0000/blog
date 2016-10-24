@extends('layouts.default')

@section('main')
<div class="am-g am-g-fixed">
    <div class="am-u-sm-12">
        <br/>
        <blockquote>Tag: <span class="am-badge am-badge-success am-radius">{{ $tag->name }}</span></blockquote>
        @foreach($articles as $article)
        <article class="blog-main">
            <h3 class="blog-main">
                <a href="{{ URL::route('article.show', $article->id) }}">{{ $article->title }}</a>
            </h3>
            <h4 class="am-article-meta blog-meta">
                by <a href="{{ URL::to('user/'.$article->id.'/articles') }}">{{ $article->user->nickname }}</a> posted on {{ $article->created_at->format('Y/m/d H:i') }} under
                @foreach($article->tags as $tag)
                    <a href="{{ URL::to('tag/'.$tag->id.'/articles') }}" style="color: #fff;" class="am-badge am-badge-success am-radius">{{ $tag->name }}</a>
                @endforeach
            </h4>
            <div class="am-g">
                <div class="am-u-sm-12">
                    @if ($article->summary)
                        <p>{{ $article->summary }}</p>
                    @endif
                    <hr class="am-article-divider"/>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>
@stop