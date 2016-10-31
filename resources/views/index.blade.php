{{-- index.blade.php --}}
{{-- Display article&tag list --}}

@extends('layouts.default')

@section('main')

    <div class="col-sm-8">
        <ul>
        @foreach ($articles as $article)
        <li>
            <div class="article_content">
                <h3>
                    <a href="{{ URL::route('article.show', $article->id) }}">{{ $article->title }}</a>
                </h3>
            <h4>
                by <a href="{{ URL::to('user/'.$article->user->id.'/articles') }}">{{ $article->user->nickname }}</a> posted on {{ $article->created_at->format('Y/m/d H:i') }} under
                @foreach ($article->tags as $tag)
                <a href="{{ URL::to('tag/'.$tag->id.'/articles') }}" style="color: #fff;" class="label label-success label-as-badge"> {{ $tag->name }}</a>
                @endforeach
            </h4>

            @if ($article->summary)
               <p>{{ $article->summary }}</p>
            @endif
        </li>
        @endforeach
        </ul>
        <div class="text-center">
            {!! $articles->render() !!}
        </div>
    </div>

    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::to('tag/') }}"><span class="glyphicon glyphicon-tags"></span> Tags</a>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach( $tags as $tag)
                    <li class="list-group-item">
                        <a href="{{ URL::to('tag/'.$tag->id.'/articles') }}">{{ $tag->name }}
                        <span class="badge pull-right">{{ $tag->count }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            </section>       
        </div>
    </div>

{{--
<script>
$(function() {
    $('ul.pagination li').css({
        "display" : "inline",
        "list-style-type" : "none",
        "padding" : "5px",
    });
});
</script>
--}}
@stop
