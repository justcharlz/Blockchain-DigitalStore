@extends('layouts.master')

@section('app-content')

<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Please Log in</div>
				<div class="panel-body">
					<form role="form" method="POST" action="/login">
            {{ csrf_field() }}
						<fieldset>
							<div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" autofocus="">
							</div>
							<div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" id="password">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
              <button class="btn btn-primary" type="submit">Login</button>
              <a class="btn btn-link" href="/password/reset">Forgot Password</a>
              <a class="btn raw100 btn-success pull-right" href="/register">Register</a>
            </fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->


@stop
