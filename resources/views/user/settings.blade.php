@extends('dashboard')

@section('pageTitle') Settings @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-2 col-md-offset-2">

              <img src= {{ asset($user->pix) }} class="img-responsive" />
            </div>
                <div class="col-xs-10 col-sm-8 col-md-4">

            <form method="POST" action="/user/settings" enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div>
                    @input_maker_label('Profile pix')
                    @input_maker_create('pix', ['type' => 'file'], $user)
                </div>

                <div>
                    @input_maker_label('Email')
                    @input_maker_create('email', ['type' => 'string'], $user)
                </div>

                <div class="raw-margin-top-24">
                    @input_maker_label('Name')
                    @input_maker_create('name', ['type' => 'string'], $user)
                </div>

                @include('user.meta')

                @if ($user->roles->first()->name === 'admin' || $user->id == 1)
                    <div class="raw-margin-top-24">
                        @input_maker_label('Role')
                        @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'], $user)
                    </div>
                @endif

                <div class="raw-margin-top-24">
                    <div class="btn-toolbar justify-content-between">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a class="btn btn-link" href="/user/password">Change Password</a>
                    </div>
                </div>
            </form>
          </div>
        </div>
        </div>
    </div>

@stop
