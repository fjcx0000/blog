@extends("layouts.default")

@section("main")
        <div class="col-sm-12">
            <table class="table table-hover table-striped">
                <thread>
                    <tr>
                        <th>Title</th>
                        <th>Tags</th>
                        <th>Author</th>
                        <th>Management</th>
                    </tr>
                </thread>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td><a href="{{ URL::route('article.show', $article->id) }}">{{ $article->title }}</a> </td>
                        <td>
                            @foreach($article->tags as $tag)
                                <a href="{{ URL::to('tag/'.$tag->id.'/articles') }}">
                                    <span class="label label-success label-as-badge">{{ $tag->name }}</span>
                                </a>
                            @endforeach
                        </td>
                        <td><a href="{{ URL::to('user/' . $article->user->id . '/articles') }}">{{ $article->user->nickname }}</a> </td>
                        <td>
                            <a href="{{ URL::to('article/' . $article->id . '/edit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                            {{ Form::open(array('url'=>'article/' . $article->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
                            <button type="button" class="btn btn-danger" id="delete{{ $article->id }}" data-title="{{ $article->title }}"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts.delete_confirm')

    @stop