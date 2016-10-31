@extends('layouts.default')

@section('main')

    <div class="col-sm-12">
        <h1>Publish Article</h1>
        @include('errors.message')

        {{ Form::open(array('url' => 'article', 'role' => 'form')) }}
            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ Request::old('title') }}" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="20" class="form-control">{{ Request::old('content') }} </textarea>
                <button id="preview" type="button" class="btn btn-primary" class="form-control"><span class="glyphicon glyphicon-eye-open"></span> Preview</buttton>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" value="{{ Request::old('tags') }}" class="form-control"/>
                <p class="help-block">Separate multiple tags with a comma ","</p>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-send"></span> Publish</button>
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
