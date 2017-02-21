<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/favicon.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        {!! Html::style('frontend/css/app.css?'.time()) !!}
        {!! Html::style('frontend/css/blocks.css?'.time()) !!}
        {!! Html::style('frontend/css/style.css?'.time()) !!}

        <!-- CSS Header and Footer -->
        {!! Html::style('frontend/css/headers/header-v6.css?'.time()) !!}
        {!! Html::style('frontend/css/footers/footer-v1.css?'.time()) !!}

        <!-- CSS Implementing Plugins -->
            {!! Html::style('frontend/plugins/animate.css') !!}
        {!! Html::style('frontend/plugins/line-icons/line-icons.css') !!}
        {!! Html::style('frontend/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('frontend/plugins/revolution-slider/rs-plugin/css/settings.css') !!}
        <!--[if lt IE 9]>{!! Html::style('frontend/plugins/revolution-slider/rs-plugin/css/settings-ie8.css') !!}<![endif]-->

            <!-- CSS Theme -->
        {!! Html::style('frontend/css/theme-colors/default.css') !!}
        {!! Html::style('frontend/css/theme-skins/dark.css?'.time()) !!}

        @yield('custom-styles')
        {!! Html::style('frontend/plugins/brand-buttons/brand-buttons.css') !!}
        {!! Html::style('frontend/plugins/brand-buttons/brand-buttons-inversed.css') !!}

        <!-- CSS Customization -->
        {!! Html::style('frontend/css/custom.css?'.time()) !!}

    @show


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {!! Html::style('//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') !!}
    {!! Html::style('//oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
<![endif]-->
</head>
<body class="header-fixed header-fixed-space frontend" ng-app="tradeeApp" ng-controller="MainController" ng-init="getAuthenticatedUser()">
    <div class="wrapper">
        @section('header')
            @include('partial/header')
        @show

        @yield('body')

        @section('footer')
            @include('partial/footer')
        @show
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
        {!! Html::script('frontend/plugins/jquery.easing.min.js') !!}
        {{--{!! Html::script('frontend/plugins/jquery.parallax.js') !!}--}}
        {!! Html::script('frontend/plugins/counter/waypoints.min.js') !!}
        {{--{!! Html::script('frontend/plugins/counter/jquery.counterup.min.js') !!}--}}

        <!-- JS Customization -->
        {!! Html::script('frontend/js/custom.js?'.time()) !!}

        <!-- JS Page Level -->
        {!! Html::script('frontend/js/app.js') !!}
        {{--{!! Html::script('frontend/js/plugins/style-switcher.js') !!}--}}
        {{--{!! Html::script('frontend/js/plugins/revolution-slider.js') !!}--}}
        <script type="text/javascript">
            jQuery(document).ready(function() {
                App.init();
//                App.initCounter();
//                App.initParallaxBg();
//                StyleSwitcher.initStyleSwitcher();
//                RevolutionSlider.initRSfullScreenOffset();

                //jQuery for page scrolling feature - requires jQuery Easing plugin
                $(function() {
                    $('.page-scroll a').bind('click', function(event) {
                        var $anchor = $(this);
                        $('html, body').stop().animate({
                            scrollTop: $($anchor.attr('href')).offset().top
                        }, 1000, 'easeInOutExpo');
                        event.preventDefault();
                    });
                });
            });
        </script>
        {!! Form::open(['url' => '/logout', 'id' => 'logout-form', 'style' => 'display: none;']) !!}
        {!! Form::close() !!}
    @show
    @yield('custom-scripts')
</html>