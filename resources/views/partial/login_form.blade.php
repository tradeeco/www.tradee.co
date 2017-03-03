<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('username') && Session::get('last_auth_attempt') == 'login' ? ' has-error' : '' }}">
        <input id="username" type="text" placeholder="Username" class="form-control input-lg rounded" name="username" value="{{ old('username') }}" required autofocus>

        @if ($errors->has('username') && Session::get('last_auth_attempt') == 'login')
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') && Session::get('last_auth_attempt') == 'login' ? ' has-error' : '' }}">
        <input id="password" type="password" placeholder="Password" class="form-control input-lg rounded" name="password" required>

        @if ($errors->has('password') && Session::get('last_auth_attempt') == 'login')
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                </label>
            </div>
        </div>
    </div>

    <div class="form-group  text-center">
        <button type="submit" class="btn btn-primary btn-lg rounded btn-block">
            Login
        </button>

        <a class="btn btn-link color-white" href="{{ url('/password/reset') }}">
        Forgot Your Password?
        </a>
    </div>
</form>