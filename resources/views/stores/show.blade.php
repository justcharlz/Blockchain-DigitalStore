@extends('dashboard')

@section('pageTitle') Beat details @stop

@section('content')
<div class="col-xs-10 col-sm-8 col-md-3">

      <img src= {{ asset($stores->cover) }} class="img-responsive" />

</div>
<div class="col-xs-10 col-sm-8 col-md-4">
<dl class="dl-horizontal lead">
<dt>Genre</dt><dd>{{$stores->music_genre}}</dd>
<dt>Name</dt><dd>{{ $stores->name}}</dd>
<dt>Beat per Minute</dt><dd> {{$stores->bpm}}</dd>
<dt>Length</dt><dd> {{$stores->length}}</dd>
 <dt>Price</dt><dd>{{$stores->beat_price}}</dd>
</dl>
<form action="/stores/{{$stores->id}}" method="POST" enctype="multipart/form-data" class="pull-right" />
  {{ method_field('DELETE') }}
{{ csrf_field() }}
<a href={{'/stores/'.$stores->id.'/edit'}} class="btn btn-sm btn-warning" role="button"  data-toggle="tooltip" data-placement="bottom" title="edit"><span class="fa fa-edit"></span> Edit</a>

<button href="/stores/{{$stores->id}}/destroy" onclick="confirm('You sure you want to delete?')" class="btn btn-danger btn-sm "><span class="fa fa-trash"></span> Delete</button>

</form>
</div>
@stop
