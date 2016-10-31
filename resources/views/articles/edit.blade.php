@extends('layouts.default')

@section('main')
    <div class="col-sm-12">
        <h1>Edit Article</h1>
        <hr/>
        @include('errors.message')
        {{ Form::model($article, array('url' => URL::route('article.update', $article->id), 'method' => 'PUT', 'role' => 'form')) }}
            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', Request::old('title'), array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
            {{ Form::label('content', 'Content') }}
            {{ Form::textarea('content', Request::old('content'), array('rows' => '20', 'class' => 'form-control')) }}
            <p class="help-block">
                <button id="preview" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> Preview</button>
            </p>
        </div>
        <div class ="form-group">
        {{ Form::label('tags', 'Tags') }}
        {{ Form::text('tags', Request::old('tags'), array('class' => 'form-control')) }}
        <div class ="form-group">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modify</button>
        </div>
        {{ Form::close() }}
    </div>


<div class="modal fade" id="preview-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
             <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                </div>
             </div>
        </div>
    </div>
<script>
    $(function() {
        $('#preview').on('click', function() {
            $('.modal-title').text($('#title').val());
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            $.post('preview', {'content': $('textarea#content').val()}, function(data, status) {
                $('.modal-body').html(data);
            });
            $('#preview-popup').modal();
        });
    });
</script>
@stop
