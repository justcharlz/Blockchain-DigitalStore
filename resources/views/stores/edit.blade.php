@extends('dashboard')

@section('pageTitle') Edit Beat @stop

@section('content')
<div class="col-xs-10 col-sm-8 col-md-3">

      <img src= {{ asset($stores->cover) }} class="img-responsive" />
      <form action="/stores/{{$stores->id}}" method="POST" />
        {{ method_field('DELETE') }}
      {{ csrf_field() }}
      <button onclick="confirm('You sure you want to delete?')" class="btn btn-danger btn-md pull-right">Delete Beat</button>
      </form>
</div>
<div class="col-xs-10 col-sm-8 col-md-4">
<form action="/stores/{{$stores->id}}" method="POST" enctype="multipart/form-data" />
  {{ method_field('PATCH') }}
{{ csrf_field() }}
<fieldset>
<div class="form-group">
  @input_maker_label('Beat Image')
  @input_maker_create('cover', ['type' => 'file', 'default_value' =>  $stores->cover ])
</div>
<div class="form-group">
  @input_maker_create('music_genre', ['type' => 'select', 'options' => ['Afrobeat' => 'Afrobeat', 'Calypso' => 'Calypso'], 'default_value' =>  $stores->music_genre ])
</div>
<div class="form-group">
  @input_maker_create('name', ['type' => 'string', 'placeholder' => 'Name of Beat', 'default_value' =>  $stores->name ])
</div>
<div class="form-group">
  @input_maker_create('bpm', ['type' => 'integer', 'placeholder' => 'Beat per Minute', 'default_value' => $stores->bpm ])
</div>
<div class="form-group">
  @input_maker_create('length', ['type' => 'integer', 'placeholder' => 'Beat Length', 'default_value' => $stores->length ])
</div>
<div class="form-group">
  @input_maker_create('beat_price', ['type' => 'integer', 'placeholder' => 'Cost($)', 'default_value' => $stores->beat_price ])
</div>
<div class="form-group">
  @input_maker_label('Beat File')
  @input_maker_create('beat', ['type' => 'file', 'default_value' => $stores->path ])
</div>
<!-- Form actions -->
<div class="form-group">
  <div class="col-md-12 widget-right">
    <button type="submit" class="btn btn-info btn-md pull-left">Update</button>
</div>
</div>
</fieldset>
</form>

</div>
@stop
