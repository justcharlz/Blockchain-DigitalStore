@extends('dashboard')

@section('pageTitle') Decent Wallet: Create @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <form method="post" action="{{ url('wallet/create') }}">
                        {!! csrf_field() !!}

                      @form_maker_table("walletname", ['name' => 'string', 'placeholder' => 'Wallet Address'])

                        <div class="raw-margin-top-24">
                            <button class="btn btn-primary pull-left" type="submit">Create Wallet</button>
                            <a class="btn btn-secondary pull-right" href="{{ url('wallet') }}">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
