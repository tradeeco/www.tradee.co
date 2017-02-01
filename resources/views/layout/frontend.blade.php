<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/favicon.png">

    @yield('meta-common')
    @yield('meta-custom')
    <title>
        Tradee
    </title>

    @yield('head-scripts')

    {{--{!! Html::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}--}}

    @section('styles')
        {!! Html::style('http://fonts.googleapis.com/css?family=Quicksand:400,300,500,700&amp;subset=cyrillic,latin') !!}

        <!-- CSS Global Compulsory -->
        {!! Html::style('frontend/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('frontend/css/style.css') !!}

        <!-- CSS Header and Footer -->
        {!! Html::style('frontend/css/headers/header-v6.css') !!}
        {!! Html::style('frontend/css/footers/footer-v1.css') !!}

        <!-- CSS Implementing Plugins -->
            {!! Html::style('frontend/plugins/animate.css') !!}
        {!! Html::style('frontend/plugins/line-icons/line-icons.css') !!}
        {!! Html::style('frontend/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('frontend/plugins/revolution-slider/rs-plugin/css/settings.css') !!}
        <!--[if lt IE 9]>{!! Html::style('frontend/plugins/revolution-slider/rs-plugin/css/settings-ie8.css') !!}<![endif]-->

            <!-- CSS Theme -->
        {!! Html::style('frontend/css/theme-colors/default.css') !!}
        {!! Html::style('frontend/css/theme-skins/dark.css') !!}

        <!-- CSS Customization -->
        {!! Html::style('frontend/css/custom.css') !!}
        {!! Html::style(elixir('css/all.css')) !!}
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
    @show

    @yield('custom-styles')

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {!! Html::style('//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') !!}
    {!! Html::style('//oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
<![endif]-->
</head>
<body class="header-fixed" ng-app="tradeeApp" ng-controller="MainController" ng-init="getAuthenticatedUser()">
    <div class="wrapper">
        @section('header')
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
                                    TRADEE
                                </a>
                            </div>
                            <!-- ENd Navbar Brand -->
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-responsive-collapse">
                            <div class="menu-container">
                                <ul class="nav navbar-nav">
                                    <li ng-class="{active:isActive('/todos')}">
                                        <a href="/todos">
                                            List Todos
                                        </a>
                                    </li>
                                    <!-- Home -->
                                    <li class="dropdown">
                                        <a href="javascript:void(0);">
                                            Sign In
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="button">
                                            <button class="btn btn-warning rounded">Sign Up</button>
                                        </a>
                                    </li>
                                    <!-- End Home -->
                                </ul>
                            </div>
                        </div><!--/navbar-collapse-->
                    </div>
                </div>
                <!-- End Navbar -->
            </div>
            <!--=== End Header v6 ===-->
        @show

        @yield('body')

        @yield('footer')
    </div>
</body>

    @section('scripts')
        <!-- JS Global Compulsory -->
        {!! Html::script('frontend/plugins/jquery/jquery.min.js') !!}
        {!! Html::script('frontend/plugins/jquery/jquery-migrate.min.js') !!}
        {!! Html::script('frontend/plugins/bootstrap/js/bootstrap.min.js') !!}

        <!-- JS Implementing Plugins -->
        {!! Html::script('frontend/plugins/back-to-top.js') !!}
        {!! Html::script('frontend/plugins/smoothScroll.js') !!}
        {!! Html::script('frontend/plugins/jquery.parallax.js') !!}
        {!! Html::script('frontend/plugins/counter/waypoints.min.js') !!}
        {!! Html::script('frontend/plugins/counter/jquery.counterup.min.js') !!}
        {!! Html::script('frontend/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js') !!}
        {!! Html::script('frontend/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js') !!}

        <!-- JS Customization -->
        {!! Html::script('frontend/js/custom.js') !!}

        <!-- JS Page Level -->
        {!! Html::script('frontend/js/app.js') !!}
        {!! Html::script('frontend/js/plugins/style-switcher.js') !!}
        {!! Html::script('frontend/js/plugins/revolution-slider.js') !!}
        <script type="text/javascript">
            jQuery(document).ready(function() {
                App.init();
                App.initCounter();
                App.initParallaxBg();
                StyleSwitcher.initStyleSwitcher();
                RevolutionSlider.initRSfullScreenOffset();
            });
        </script>
        {!! Html::script(elixir('js/all.js')) !!}

    @show
    @yield('custom-scripts')
</html>