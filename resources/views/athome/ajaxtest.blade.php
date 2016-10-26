@extends('athome.layouts.default')

@section('title')
    Athome Edition
@stop

@section('main')
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-default" onclick="testCreate();">Create Athome</button>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary" onclick="testEdit();">Edit Athome</button>
        </div>
    </div>
    <div class="row">
        <p id="response"></p>
    </div>

    <script>
    function testEdit()
    {

        $.ajax({
            type: "GET",
            contentType: "appliacation/json; charset=utf-8",
            dataType: "json",
            url: "{{ URL::to('athome/6') }}",
            success: function(data) {
                var athome = data;
                athome.temperature += 5;
                athome.sensor1 += 5;
                athome.sensor2 += 5;
                athome.led1 ^= 1;
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-HTTP-Method-Override': 'PUT'},
                    dataType: "json",
                    url: "{{ URL::to('athome/6') }}",
                    data: JSON.stringify(athome),
                    success: function(data) {
                        $('#response').attr('class', 'text-success');
                        $('#response').html(JSON.stringify(data));
                    },
                    error: function(err) {
                        $('#response').attr('class', 'text-warning');
                        $('#response').html(err);
                    },
                })
            },
            error: function(err) {
                $('#response').attr('class', 'text-warning');
                $('#response').html(err);

            },
        })
    }

    function testCreate()
    {
        var athome = {
            "temperature" : 15,
            "sensor1" : 26,
            "sensor2" : 25,
            "led1" : 0,
        };
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url: "{{ URL::to('athome') }}",
            data: JSON.stringify(athome),
            success: function(data) {
                $('#response').attr('class', 'text-success');
                $('#response').html(JSON.stringify(data));
            },
            error: function(err) {
                $('#response').attr('class', 'text-warning');
                $('#response').html(err);

            },
        })
    }
    </script>

@stop