<!DOCTYPE html>
<html lang="en">
<head>
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

    @yield('styles')

    @yield('custom-styles')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {!! Html::style('//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') !!}
    {!! Html::style('//oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
    <![endif]-->
</head>
<body class="header-fixed">
    <div class="wrapper">
        @yield('header')

        @yield('body')

        @yield('footer')
    </div>
</body>

    @yield('header-scripts')
    @yield('scripts')
    @yield('custom-scripts')
</html>
