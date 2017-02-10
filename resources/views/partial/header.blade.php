<div class="header-v6 header-classic-white header-sticky">
    <!-- Navbar -->
    <div class="navbar mega-menu" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Navbar Brand -->
                <div class="navbar-brand">
                    <a href="{!! URL::to('/') !!} ">
                        <img class="shrink-logo" src="img/logo.png" alt="Logo">
                    </a>
                </div>
                <!-- ENd Navbar Brand -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="javascript:void(0);"  id="sign_in">
                                How It Works
                            </a>
                        </li>
                        <!-- Home -->
                        @if (Auth::check())
                            <li>
                                <a href="{!! URL::to('/logout') !!}" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();" class="button">
                                    <button class="btn btn-warning rounded">Sign Out</button>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="javascript:void(0);"  id="sign_in">
                                    Sign In
                                </a>
                                <div class="sign-in-wrap">
                                    <form class="form-horizontal" id="sign_in_form" role="form" method="POST" action="{{ url('/api/login') }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-5" style="padding-right: 5px;">
                                                <input type="text" class="form-control rounded" id="username" name="username" placeholder="Username">
                                            </div>
                                            <div class="col-md-5" style="padding-left: 5px; padding-right: 5px;">
                                                <input type="password" class="form-control rounded" id="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="col-md-2" style="padding-left: 5px;">
                                                <button type="submit" class="btn btn-primary rounded">Sign in</button>
                                            </div>
                                        </div>
                                        <p><span>Dont have have an account yet?</span> <a href="{!! URL::to('/register') !!}">Sign Up here for free!</a></p>
                                    </form>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="{!! URL::to('/register') !!}" class="button">
                                    <button class="btn btn-warning rounded">Sign Up</button>
                                </a>
                            </li>
                    @endif
                    <!-- End Home -->
                    </ul>
                </div>
            </div><!--/navbar-collapse-->
        </div>
    </div>
    <!-- End Navbar -->
</div>
<!--=== End Header v6 ===-->