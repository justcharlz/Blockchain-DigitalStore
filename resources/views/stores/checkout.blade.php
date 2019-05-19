@extends('pagetpl')

@section('pageTitle') Product Checkout @stop

@section('content')
<h1>@yield('pageTitle'): {{ $stores->name}}</h1>
{{$status ?? 'Try again'}}
<div class="col-xs-10 col-sm-8 col-md-3">
      <img src= {{ asset($stores->cover) }} class="img-responsive" />

</div>
<div class="col-xs-10 col-sm-8 col-md-5">
<dl class="dl-horizontal lead">
<dt>Genre</dt><dd>{{$stores->music_genre}}</dd>
<dt>Name</dt><dd>{{ $stores->name}}</dd>
<dt>Beat per Minute</dt><dd> {{$stores->bpm}}</dd>
<dt>Length</dt><dd> {{$stores->length}}</dd>
 <dt>Price</dt><dd>{{$stores->beat_price}} AR</dd>
</dl>
<span class="lead">Pay in Arweave Token to download beat.</span>
<a class="btn btn-sm btn-success" href="{{'/tokentransfer/'.$stores->id}}">Transfer Token</a>
</div>
<div class="col-xs-10 col-sm-8 col-md-3">
  <div class="lead">

</div>
</div>
@stop
