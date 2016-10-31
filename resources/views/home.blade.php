@extends("layouts.default")

@section('main')

    <div class="col-sm-12">
        <table class="table table-hover table-striped">
            <thead>
                <tr >
                    <th style='vertical-align: middle;text-align: center;'>Title</th>
                    <th style='vertical-align: middle;text-align: center;'>Tags</th>
                    @if ($user->id == Auth::id())
                    <th style='vertical-align: middle;text-align: center;'>Management</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr >
                    <td style='vertical-align: middle'>{{ $article->title }}</td>
                    <td style='vertical-align: middle'>
                        @foreach ($article->tags as $tag)
                        <span class="label label-success label-as-badge pull-right">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    @if ($user->id == Auth::id() or Auth::user()->is_admin)
                    <td>
                        <a href="{{ URL::to('article/'.$article->id.'/edit') }}" class="btn am-btn-primary"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                        {{ Form::open(array('url' => 'article/'.$article->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
                            <button type="button" class="btn btn-danger" id="delete{{ $article->id }}" data-title="{{ $article->title }}"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                        {{ Form::close() }}
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@include('layouts.delete_confirm')

@stop
