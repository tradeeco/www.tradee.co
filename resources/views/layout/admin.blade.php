<!DOCTYPE html>
<html lang="en">
<head>
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
		{{ config('app.name', 'Trade Admin') }}: Admin
	</title>

@yield('head-scripts')

{{--{!! Html::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}--}}

@section('styles')
	{!! Html::style('http://fonts.googleapis.com/css?family=Quicksand:400,300,500,700&amp;subset=cyrillic,latin') !!}

	{!! Html::style('backend/css/bootstrap.min.css') !!}
	{!! Html::style('backend/font-awesome/css/font-awesome.css?'.time()) !!}


	@yield('custom-styles')

	{!! Html::style('backend/css/animate.css?'.time()) !!}
	{!! Html::style('backend/css/style.css?'.time()) !!}

	{!! Html::style('frontend/css/custom.css?'.time()) !!}
@show


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	{!! Html::style('//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') !!}
	{!! Html::style('//oss.maxcdn.com/respond/1.4.2/respond.min.js') !!}
	<![endif]-->
</head>
<body class="{{ isset($controller) && ($controller == 'LoginController') ? 'gray-bg' : '' }}">
<div id="wrapper">
	@section('left-menu')
	@if (!Auth::guest())
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                         </span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                         </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><a href="profile.html">Profile</a></li>
								<li><a href="contacts.html">Contacts</a></li>
								<li><a href="mailbox.html">Mailbox</a></li>
								<li class="divider"></li>
								<li><a href="login.html">Logout</a></li>
							</ul>
						</div>
						<div class="logo-element">
							TRA
						</div>
					</li>
					<li class="active">
						<a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li class="active"><a href="index.html">Dashboard v.1</a></li>
							<li><a href="dashboard_2.html">Dashboard v.2</a></li>
							<li><a href="dashboard_3.html">Dashboard v.3</a></li>
							<li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
							<li><a href="dashboard_5.html">Dashboard v.5 </a></li>
						</ul>
					</li>

					<li class="special_link">
						<a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
					</li>
				</ul>

			</div>
		</nav>
	@endif
	@show
	<div id="page-wrapper" class="gray-bg">
		@include('admin/partial/topbar')
		@yield('content')
	</div>
	@yield('footer')
</div>
@section('scripts')
	<form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
	{!! Html::script('backend/js/jquery-2.1.1.js') !!}
	{!! Html::script('backend/js/bootstrap.min.js') !!}
	{!! Html::script('backend/js/plugins/metisMenu/jquery.metisMenu.js') !!}
	{!! Html::script('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}

	<!-- Custom and plugin javascript -->
	{!! Html::script('backend/js/inspinia.js?'.time()) !!}
	{!! Html::script('backend/js/plugins/pace/pace.min.js') !!}
@show
@yield('custom-scripts')
</body>
</html>