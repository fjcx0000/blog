{{--
List records delete operation confirm modal and submit operation
--}}
<div class="modal fade" tabindex="-1" id="my-confirm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <!--
            <div class="modal-body"></div>
            -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> No</button>
                <butoon type="button" class="btn btn-primary" id="confirm-delete"> Yes</butoon>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('[id^=delete]').on('click', function() {
            var recordId;
            recordId = $(this).attr('id');
            $('.modal-title').text('Sure you want to delete the record? '+ $(this).attr('data-title'));
            $('#my-confirm').modal({
            });
            $('#confirm-delete').on('click', function() {
                $('#'+recordId).parent('form').submit();
            });
        });

    });
</script>