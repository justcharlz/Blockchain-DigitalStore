@extends('dashboard')

@section('pageTitle') Wallet: All @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                  @foreach($wallet as $wallets)
                  <li>{{$wallets}}</li>
                  @endforeach
              </div>
            </div>
        </div>
    </div>

@stop
