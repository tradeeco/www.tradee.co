<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" style="position: relative;">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-5 margin-top-40">
            <a href="#" class="btn btn-block btn-facebook-inversed rounded btn-u-lg margin-bottom-20" style="font-size: 15px;">
                <i class="fa fa-facebook"></i>
                Sign-up with Facebook
            </a>
            <a href="#" class="btn btn-block btn-googleplus-inversed rounded btn-u-lg margin-bottom-20" style="font-size: 15px;">
                <i class="fa fa-google-plus"></i>
                Sign-up with Google+
            </a>
        </div>
        <div class="col-md-1 vertical-divider"></div>
        <div class="col-md-6 col-md-offset-1">
            <div class="form-group{{ $errors->has('username') && Session::get('last_auth_attempt') == 'register' ? ' has-error' : '' }}">

                <input id="username" type="text" class="form-control input-lg rounded" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username') && Session::get('last_auth_attempt') == 'register' )
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control input-lg rounded" placeholder="Email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') && Session::get('last_auth_attempt') == 'register' ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control input-lg rounded" placeholder="Password" name="password" required>

                @if ($errors->has('password') && Session::get('last_auth_attempt') == 'register')
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control input-lg rounded" placeholder="Confirm Password"  name="password_confirmation" required>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-primary btn-u-lg rounded">
                        SIGN UP
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>