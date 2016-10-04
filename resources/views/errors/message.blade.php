@if (Session::has('message'))
<div class="am-alert am-alert-{{ Session::get('message')['type'] }}" data-am-alert>
     <p>{{ Session::get('message')['content'] }}</p>
</div>
@endif
@if ($errors->count())
<div class="am-alert am-alter-danger" data-am-alert>
     <p> {{ $errors->first() }}</p>
</div>
@endif
