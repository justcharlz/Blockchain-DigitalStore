@extends('pagetpl')

@section('pageTitle') Beat details @stop

@section('content')
<h1>@yield('pageTitle'): {{ $stores->name}}</h1>
<div class="col-xs-10 col-sm-8 col-md-3">
      <img src= {{ asset($stores->cover) }} class="img-responsive" />

</div>
<div class="col-xs-10 col-sm-8 col-md-4">
<dl class="dl-horizontal lead">
<dt>Genre</dt><dd>{{$stores->music_genre}}</dd>
<dt>Name</dt><dd>{{ $stores->name}}</dd>
<dt>Beat per Minute</dt><dd> {{$stores->bpm}}</dd>
<dt>Length</dt><dd> {{$stores->length}}</dd>
 <dt>Price</dt><dd>${{$stores->beat_price}}/0 AR</dd>
</dl>

</div>
<div class="col-xs-10 col-sm-8 col-md-4">
  <div class="lead">
About Producer
</div>
</div>
@stop
