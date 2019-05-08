@extends('dashboard')

@section('pageTitle') Wallet: Create @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                  Wallet Balance:
                    <form method="post" action="{{ url('wallet') }}">
                        {!! csrf_field() !!}

                      @input_maker_create("wallet", ['type' => 'string', 'placeholder' => 'Wallet Address'])

                        <div class="raw-margin-top-24">
                            <button class="btn btn-primary pull-left" type="submit">Create Wallet</button>
                            <a class="btn btn-secondary pull-right" href="{{ url('wallet') }}">Cancel</a>
                        </div>

                    </form>
                </div>

                <div class="col-md-4">
                  @foreach($wallet as $wallets)
                  {{$wallets}}
                  @endforeach
              </div>
            </div>
        </div>
    </div>

@stop
