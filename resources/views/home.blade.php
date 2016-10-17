@extends("layouts.default")

@section('main')
<div class="am-g am-g-fixed blog-g-fixed">
    <div class="am-u-sm-12">
        <table class="am-table am-table-hover am-table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Tags</th>
                    @if ($user->id == Auth::id())
                    <th>Management</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>
                        @foreach ($article->tags as $tag)
                        <span class="am-badge am-badge-success am-radius">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    @if ($user->id == Auth::id())
                    <td>
                        <a href="{{ URL::to('article/'.$article->id.'/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"></span> Edit</a>
                        {{ Form::open(array('url' => 'article/'.$article->id, 'method' => 'DELETE', 'style' => 'display: inline;')) }}
                            <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $article->id }}" articleName="{{ $article->title }}"><span class="am-icon-remove"></span> Delete</button>
                        {{ Form::close() }}
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
    <div class="am-modal-dialog">
        <div class="am-modal-bd">
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel> No</span>
            <span class="am-modal-btn" data-am-modal-confirm> Yes<span>
        </div>
    </div>
</div>
<script>
$(function() {
    $('[id^=delete]').on('click', function() {
        $('.am-modal-bd').text('Sure you want to delete the article? '+ $(this).attr('articleName'));
        $('#my-confirm').modal({
            relatedTarget: this,
            onConfirm: function(options) {
                $(this.relatedTarget).parent().submit();
            },
            onCancel: function() {
            }
        });
    });
});
</script>
@stop
