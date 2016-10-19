@extends('layouts.default')

@section('main')
<div class="am-g am-g-fixed blog-g-fixed">
    <div class="am-u-sm-12">
        <table class="am-table am-table-hover am-trable-straped">
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
                        <a href="{{ URL::to('tag/'.$tag->id.'/edit') }}" class="am-btn am-btn-xs am-btn-primary"><span class="am-icon-pencil"> Edit</span></a>
                        {{ Form::open(array('url' => 'tag/'.$tag->id, 'method' => 'DELETE', 'style' => 'display:inline')) }}
                            <button type="button" class="am-btn am-btn-xs am-btn-danger" id="delete{{ $tag->id }}"><span class="am-icon-remove"> Delete</span></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
    <div class="am-modal-config">
        <div class="am-modal-bd">
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel> N</span>
            <span class="am-modal-btn" data-am-modal-confirm> S</span>
        </div>
    </div>
</div>

<script>
$(function () {
    $('[id=^delete]').on('click', function () {
        $('.am-modal-bd').text('Sure you want to delete it?');
        $('#my-confirm').modal({
            relativeTarget: this,
            onConfirm: function (options) {
                $(this.relativeTarget).parent().submit();
            },
            onCancel: function () {
            }
        });
    });
});
</script>
@stop