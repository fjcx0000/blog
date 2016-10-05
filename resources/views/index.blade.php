@extends('layouts.default')

@section('main')
<div class="am-g am-g-fixed blog-g-fixed">
    <div class="am-u-sm-12">
        <h1> My Facades Test, {{ TestService::doSomething() }} </h1>
    </div>
</div>
@stop
