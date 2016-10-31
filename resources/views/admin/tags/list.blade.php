@extends('layouts.default')

@section('main')
    <div class="col-sm-12">
        <table class="table table-hover table-straped">
            <thread>
                <tr>
                    <th>TagName</th>
                    <th>ArticleCount</th>
                    <th>CreateDateTime</th>
                    <th>Management</th>
                </tr>
            </thread>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->count }}</td>
                    <td>{{ $tag->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ URL::to('tag/'.$tag->id.'/edit') }}" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"> Edit</span></a>
                        {{ Form::open(array('url' => 'tag/'.$tag->id, 'method' => 'DELETE', 'style' => 'display:inline')) }}
                            <button type="button" class="btn btn-danger" id="delete{{ $tag->id }}" data-title="{{ $tag->name }}"><span class="glyphicon glyphicon-remove"> Delete</span></button>
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