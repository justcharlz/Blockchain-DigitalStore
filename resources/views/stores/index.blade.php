@extends('dashboard')

@section('pageTitle') Upload Beat @stop

@section('content')
<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
<form action="/stores" method="post" enctype="multipart/form-data" />
<fieldset>
<div class="form-group">
  @input_maker_create('cover', ['type' => 'file', 'placeholder' => 'Cover Image'])
</div>
<div class="form-group">
  @input_maker_create('music_genre', ['type' => 'password', 'placeholder' => 'Genre'])
</div>
<div class="form-group">
  @input_maker_create('name', ['type' => 'type', 'placeholder' => 'Name of Beat'])
</div>
<div class="form-group">
  @input_maker_create('bpm', ['type' => 'type', 'placeholder' => 'Beat per Minute'])
</div>
<div class="form-group">
  @input_maker_create('length', ['type' => 'type', 'placeholder' => 'Beat Length'])
</div>
<div class="form-group">
  @input_maker_create('store_price', ['type' => 'type', 'placeholder' => 'Cost'])
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
