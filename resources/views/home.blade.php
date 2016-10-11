@extends("layouts.default")

@section('main')
<div class="am-g am-g-fixed blog-g-fixed">
    <div class="am-u-sm-12">
        @if (Auth::check())
        <h1>hello {{ Request::user()->nickname }}</h1>
        @else
        <h1> Please Login ... </h1>
        @endif
    </div>
</div>
@stop
