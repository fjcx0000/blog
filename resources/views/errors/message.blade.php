@if (Session::has('message'))
<div class="alert alert-{{ Session::get('message')['type'] }}">
     <p>{{ Session::get('message')['content'] }}</p>
</div>
@endif
@if ($errors->count())
<div class="alert alert-danger">
     <p> {{ $errors->first() }}</p>
</div>
@endif
