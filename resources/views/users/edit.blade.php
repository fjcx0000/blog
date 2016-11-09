
@extends('layouts.default')
@section('style')
    @parent
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{ URL::to('plugins/croppic/assets/css/main.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('plugins/croppic/assets/css/croppic.css') }}"/>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Mrs+Sheppards&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
@endsection

@section('bodyscript')
    @parent
    <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ URL::to('plugins/croppic/croppic.min.js') }}"></script>

    <script>
        var eyeCandy = $('#cropContainerEyecandy');
        var croppedOptions = {
            uploadUrl: '{{ URL::to("avatar/upload") }}',
            cropUrl: '{{ URL::to("avatar/crop") }}',
            outputUrlId:'avatarUrl',
            cropData:{
                'width' : eyeCandy.width(),
                'height': eyeCandy.height()
            }
        };
        var cropperBox = new Croppic('cropContainerEyecandy', croppedOptions);
    </script>
@endsection

@section('main')
    <div class="col-lg-6 col-md-8">
        <br/>
        @include('errors.message')

        {{ Form::model($user, array('url' => 'user/'.$user->id, 'method' => 'PUT', 'role' => 'form', 'class' => 'form-horizontal')) }}
        <div class="form-group">
            {{ Form::label('email', 'E-mail:', array('class' => 'col-sm-4 control-label')) }}
            <input id="email" name="email" type="email" readonly="readonly" value="{{ $user->email }}" class="form-control col-sm-offset-4 col-sm-8"/>
        </div>
        <div class="form-group">
            {{Form::label('nickname', 'Nick Name:', array('class' => 'col-sm-4 control-label')) }}
            <input id="nickname" name="nickname" type="text" value="{{{ $user->nickname }}}" class="form-control col-sm-offset-4 col-sm-8"/>
        </div>
        <div class="form-group">
            {{ Form::label('old_password', 'OldPassword:', array('class' => 'col-sm-4 control-label')) }}
            {{ Form::password('old_password',array('class' => 'form-control col-sm-offset-4 col-sm-8')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'NewPassword:', array('class' => 'col-sm-4 control-label')) }}
            {{ Form::password('password',array('class' => 'form-control col-sm-offset-4 col-sm-8')) }}
        </div>
        <div class="form-group">
            {{ Form::label('password_cofirmation', 'ConfirmPassword:', array('class' => 'col-sm-4 control-label')) }}
            {{ Form::password('password_confirmation',array('class' => 'form-control col-sm-offset-4 col-sm-8')) }}
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">Avatar</label>
            <div class="col-sm-4">
                <img src="{{ !empty($user->avatar)? URL::to('images/avatar/'.$user->avatar) : URL::to('images/avatar/default.png') }}" id="avatarImage" class="img-thumbnail" style="width:140px;height:140px;" >
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary" id="changeAvatar" data-toggle="modal" data-target="#avatarModal">Change</button>
            </div>
            <input type="hidden" id="avatarUrl" name="avatarUrl"/>
        </div>

        <div class="form-group">
            {{ Form::submit('Modify', array('class' => 'btn btn-primary col-sm-offset-4')) }}
        </div>
        {{ Form::close() }}

    </div>

    <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">change Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class=" col-md-3">
                        <div id="cropContainerEyecandy"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closeModal" class="btn btn-default" data-dismiss="modal"> Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            $('#closeModal').on('click', function(){
                if ($('#avatarUrl').val()!="") {
                    $('#avatarImage').attr('src', $('#avatarUrl').val());
                }
            });
        });
    </script>

@stop

