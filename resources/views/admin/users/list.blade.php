@extends('layouts.default')

@section('main')

    <div class="col-sm-12">
        @include('errors.message')
       <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Nickname</th>
                    <th>Management</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{{ $user->nickname }}}</td>
                    <td>
                        <a href="{{ URL::to('user/'.$user->id.'/edit') }}" class="btn btn-primary">Edit</a>
                        {{ Form::open(array('url' => 'user/'.$user->id.'/reset', 'method' => 'PUT',  'style' => 'display:inline;')) }}
                            <button type="button" class="btn btn-warning" id="reset{{ $user->id }}" data-title="{{ $user->nickname }}">Reset</button>
                        {{ Form::close() }}
                        @if ($user->block)
                        {{ Form::open(array('url' => 'user/'.$user->id.'/unblock', 'method' => 'PUT', 'style' => 'display:inline;')) }}
                            <button type="button" class="btn btn-danger" id="unlock{{ $user->id }}" data-title="{{ $user->nickname }}">Unlock</button>
                        {{ Form::close() }}
                        @else
                        {{ Form::open(array('url' => 'user/'.$user->id, 'method' => 'DELETE', 'style' => 'display:inline;')) }}
                            <button type="button" class="btn btn-danger" id="delete{{ $user->id }}" data-title="{{ $user->nickname }}">Block</button>
                        {{ Form::close() }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


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

                $('#confirm-delete').on('click', function() {
                    $('#'+recordId).parent('form').submit();
                });
                $('#my-confirm').modal({
                });
            });

            $('[id^=reset]').on('click', function() {
                var recordId;
                recordId = $(this).attr('id');
                $('.modal-title').text('Sure you want to reset the password for 123456? '+ $(this).attr('data-title'));

                $('#confirm-delete').on('click', function() {
                    $('#'+recordId).parent('form').submit();
                });
                $('#my-confirm').modal({
                });
            });

            $('[id^=unlock]').on('click', function() {
                var recordId;
                recordId = $(this).attr('id');
                $('.modal-title').text('Sure you want to unlock it? '+ $(this).attr('data-title'));

                $('#confirm-delete').on('click', function() {
                    $('#'+recordId).parent('form').submit();
                });
                $('#my-confirm').modal({
                });
            });

        });
    </script>

@stop
                          
