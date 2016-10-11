@extends('layouts.default')

@section('main')
<div class="am-g am-g-fixed">
    <div class="am-u-sm-12">
        <h1>Publish Article</h1>
        <br/>
        @include('errors.message')

        {{ Form::open(array('url' => 'article', 'class'=> 'am-form')) }}
            <div class="am-form-group">
                <label for="title">Title</label>
                <input id="title" name="title" type="text" value="{{ Request::old('title') }}" />
            </div>
            <div class="am-form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="20">{{ Request::old('content') }} </textarea>
                <button id="preview" type="button" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-eye"></span> Preview</buttton>
            </div>
            <div class="am-form-group">
                <label for="tags">Tags</label>
                <input id="tags" name="tags" type="text" value="{{ Request::old('tags') }}"/>
                <p class="am-form-help">Separate multiple tags with a comma ","</p>
            </div>
            <p><button type="submit" class="am-btn am-btn-success"><span class="am-icon-send"></span> Publish</button></p>
        {{ Form::close() }}
    </div>
</div>
<div class="am-popup" id="preview-popup">
    <div class="am-popup-inner">
        <div class="am-popup-hd">
            <h4 class="am-popup-title"></h4>
            <span data-am-modal-close class="am-close">&times;</span>
        </div>
        <div class="am-popup-bd">
        </div>
    </div>
</div>
<script>
$(function() {
    $('#preview').on('click', function() {
        $('.am-popup-title').text($('#title').val());
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        $.post('preview', {'content': $('#content').val()}, function(data, status) {
            $('.am-popup-bd').html(data);
        });
        $('#preview-popup').modal();
    });
});
</script>
@stop
