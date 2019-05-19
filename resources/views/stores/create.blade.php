@extends('dashboard')

@section('pageTitle') Upload Beat @stop

@section('content')
<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">

<form action="/stores" method="POST" enctype="multipart/form-data" />
{{ csrf_field() }}
<fieldset>
<div class="form-group">
  @input_maker_label('Beat Image')
  @input_maker_create('cover', ['type' => 'file', 'required' ])
</div>
<div class="form-group">
  @input_maker_create('music_genre', ['type' => 'select', 'options' => ['Afrobeat' => 'Afrobeat', 'Calypso' => 'Calypso'], 'required'])
</div>
<div class="form-group">
  @input_maker_create('name', ['type' => 'string', 'placeholder' => 'Name of Beat', 'required'])
</div>
<div class="form-group">
  @input_maker_create('bpm', ['type' => 'integer', 'placeholder' => 'Beat per Minute', 'required'])
</div>
<div class="form-group">
  @input_maker_create('length', ['type' => 'integer', 'placeholder' => 'Beat Length', 'required'])
</div>
<div class="form-group">
  @input_maker_create('beat_price', ['type' => 'integer', 'placeholder' => 'Cost', 'required'])
</div>
<div class="form-group">
  @input_maker_label('Beat File')
  @input_maker_create('beat', ['type' => 'file', 'required'])
</div>
<!-- Form actions -->
<div class="form-group">
  <div class="col-md-12 widget-right">
    <button type="submit" class="btn btn-info btn-md pull-right">Submit</button>
  </div>
</div>
</fieldset>
</form>
</div>
@stop
