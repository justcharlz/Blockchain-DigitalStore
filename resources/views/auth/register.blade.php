@extends('layouts.master')

@section('app-content')
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
        <div class="panel-heading text-center">Register</div>
      <div class="panel-body">
        <div class="form-small">



        <form method="POST" action="/register">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12 raw-margin-top-24">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 raw-margin-top-24">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 raw-margin-top-24">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 raw-margin-top-24">
                    <label>Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="Password Confirmation">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 raw-margin-top-24">
                    <div class="btn-toolbar justify-content-between">
                        <button class="btn btn-primary" type="submit">Register</button>
                        <a class="btn btn-link" href="/login">Login</a>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>
</div>

@stop
