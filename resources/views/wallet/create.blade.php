@extends('dashboard')

@section('pageTitle') Wallet: Add @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                  To create a wallet, go to the <a href="{{url('https://arweave.org')}}">arweave</a> website.
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
                  {{$wallets->wallet}}
                  @endforeach
              </div>
            </div>
        </div>
    </div>

@stop
