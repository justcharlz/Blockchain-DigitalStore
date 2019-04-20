@extends('dashboard')

@section('pageTitle') My Beat Store @stop

@section('content')
  <div class="row">
@foreach($stores as $store)
  <div class="col-md-3">
    <div class="panel panel-info">
      <div class="panel-heading">{{$store->name}} <span class="pull-right"><em>${{ $store->beat_price }} | 0DCT </em></span></div>
      <div class="panel-body" style="padding:0px">
      <div class="col-md-5"  style="padding:0px">
        <img src= {{ asset($store->cover) }} class="img-responsive" />
      </div>
      <div class="col-md-7">
        <dl class="dl-horizontal">
          <style>
          dl{
            margin-bottom: 2px
          }
          .dl-horizontal dt{
            width:10px
          }

          .dl-horizontal dd{
            margin-left: 20px;
            font-weight:bold
          }
          </style>
    <dt></dt>
    <dd> {{ $store->music_genre }}</dd>
                <dt></dt>
                <dd>  {{ $store->length }}min
                <dt></dt>
                <dd>  {{ number_format($store->size/1000000) }}mb</dd>
            </dl>



            <form action="/stores/{{$store->id}}" method="POST" enctype="multipart/form-data" />
              {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <a href={{'/stores/'.$store->id}} alt="show" class="btn btn-sm btn-info" role="button"  data-toggle="tooltip" data-placement="bottom" title="show"><span class="fa fa-eye"></span></a>
            <a href={{'/stores/'.$store->id.'/edit'}} class="btn btn-sm btn-warning" role="button"  data-toggle="tooltip" data-placement="bottom" title="edit"><span class="fa fa-edit"></span></a>

            <button href="/stores/{{$store->id}}/destroy" onclick="confirm('You sure you want to delete?')" class="btn btn-danger btn-sm pull-right"><span class="fa fa-trash"></span></button>

            </form>
      </div>
      </div>
    </div>
  </div>
@endforeach
</div><!-- /.row -->

@stop
