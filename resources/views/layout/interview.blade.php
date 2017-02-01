@extends('layout.main')

@section('styles')
	{!! Html::style('/assets/metronic/assets/frontend/layout/css/style.css') !!}
	{!! Html::style('/assets/metronic/assets/frontend/layout/css/style-responsive.css') !!}
	{!! Html::style('/assets/metronic/assets/frontend/layout/css/themes/blue.css') !!}
	{!! Html::style('/assets/metronic/assets/frontend/layout/css/custom.css') !!}
    {!! Html::style('/assets/css/style_bootstrap.css') !!}

    {!! Html::style('/assets/metronic/assets/global/plugins/fancybox/source/jquery.fancybox.css') !!}

    {!! Html::style('/assets/metronic/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') !!}
	{!! Html::style('/assets/metronic/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') !!}

	{!! Html::style('/assets/css/star-rating.min.css') !!}

    {!! Html::style('/assets/css/style_user.css') !!}
    {!! Html::style('/assets/css/style_company.css') !!}

    {!! Html::style('/assets/css/style_interview.css') !!}
@stop

@section('header')

    <?php if (!isset($pageNo)) { $pageNo = 0; } ?>
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <a class="company-site-logo" href="/"><img src="/assets/img/logo.png"/></a>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">

                    @if (Session::has('company_id'))
                        <ul class="nav navbar-nav pull-right" style="margin-left: 20px;">
                            <li class="setting-menu dropdown dropdown-user">
                                <a class="dropdown-toggle" dropdown-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img src="{!! HTTP_COMPANY_LOGO_PATH.$company->logo!!}">  <span><b>{!! $company->name !!}</b></span> <i class="fa fa-angle-down"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    @if (Session::get('member_id') == -1)
                                        <li class="{!! ($pageNo == 4) ? 'active' : ''!!}">
                                            <a href="{!! URL::route('company.setting.general') !!}">
                                            <i class="fa fa-user"></i> {!! trans('menu.setting') !!} </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{!! URL::route('company.auth.doLogout') !!}">
                                        <i class="fa fa-key"></i> {!! trans('menu.sign_out') !!} </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @elseif (Session::has('agency_id'))
                        <ul class="nav navbar-nav pull-right" style="margin-left: 20px;">
                            <li class="setting-menu dropdown dropdown-user">
                                <a class="dropdown-toggle" dropdown-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img src="{!! HTTP_COMPANY_LOGO_PATH.$company->logo!}">  <span><b>{!! $company->name !!}</b></span> <i class="fa fa-angle-down"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    @if (Session::get('agency_is_admin') == 1)
                                        <li class="{!! ($pageNo == 4) ? 'active' : ''!}">
                                            <a href="{!! URL::route('agency.setting.general') !!}">
                                            <i class="fa fa-user"></i> {!! trans('menu.setting') !!} </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{!! URL::route('agency.auth.doLogout') !!}">
                                        <i class="fa fa-key"></i> {!! trans('menu.sign_out') !!} </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endif

                    <ul class="list-unstyled list-inline pull-right" style="margin-top: 13px;">
                        <li><a class="color-blue {!! Session::get('locale') == 'en' ? 'font-weight-bold' : '' !!}" href="{!! URL::route('language-chooser', 'en') !!}">English</a></li>
                        <li><a class="color-blue {!! Session::get('locale') == 'fi' ? 'font-weight-bold' : '' !!}" href="{!! URL::route('language-chooser', 'fi') !!}">Finnish</a></li>
                        <li><a class="color-blue {!! Session::get('locale') == 'lv' ? 'font-weight-bold' : '' !!}" href="{!! URL::route('language-chooser', 'lv') !!}">Latvian</a></li>
                        <li><a class="color-blue {!! Session::get('locale') == 'ru' ? 'font-weight-bold' : '' !!}" href="{!! URL::route('language-chooser', 'ru') !!}">Russian</a></li>
                    </ul>
                    <i class="fa fa-globe pull-right color-blue" style="margin-top: 13px;"></i>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>
    </div>

    <div class="header">
        <div class="container">

			<a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

            <div class="header-navigation pull-right font-transform-bitter company-menu-bar">
                <ul class="nav nav-pills nav-top">
                    @if (Session::has('company_id'))
                    	<li class="{!! ($pageNo == 3) ? 'active' : ''!!}"><a href="{!! URL::route('company.dashboard') !!}">{!! trans('menu.dashboard') !!}</a></li>
                    	<li class="setting-menu dropdown dropdown-user pointer {!! ($pageNo == 1 || $pageNo == 2) ? 'active' : ''!!}">
                    	    <a class="dropdown-toggle" dropdown-toggle = "dropdown" data-hover="dropdown" data-close-others="true">{!! trans('menu.jobs') !!}</a>
                    	    <ul class="dropdown-menu">
                    	        <li class="{!! ($pageNo == 1) ? 'active' : ''!!}"><a href="{!! URL::route('company.job.add') !!}">{!! trans('menu.post_job') !!}</a></li>
                                <li class="{!! ($pageNo == 2) ? 'active' : ''!!}"><a href="{!! URL::route('company.job.myjobs' )!!}">{!! trans('menu.my_jobs') !!}</a></li>
                    	    </ul>
                    	</li>
                        <li class="setting-menu dropdown dropdown-user pointer {!! ($pageNo == 5 || $pageNo == 6 || $pageNo == 8) ? 'active' : ''!!}">
                            <a class="dropdown-toggle" dropdown-toggle = "dropdown" data-hover="dropdown" data-close-others="true">{!! trans('menu.people') !!}</a>
                            <ul class="dropdown-menu">
                                <li class="{!! ($pageNo == 5) ? 'active' : ''!!}"><a href="{!! URL::route('company.user.find' )!!}">{!! trans('menu.find_people') !!}</a></li>
                                <li class="{!! ($pageNo == 6) ? 'active' : ''!!}"><a href="{!! URL::route('company.user.applied' )!!}">{!! trans('menu.applied_people') !!}</a></li>
                                <li class="{!! ($pageNo == 8) ? 'active' : ''!!}"><a href="{!! URL::route('company.user.shared' )!!}">{!! trans('menu.shared_people') !!}</a></li>
                            </ul>
                        </li>
                        <li class="{!! ($pageNo == 7) ? 'active' : ''!!}"><a href="{!! URL::route('company.message.list' )!!}">{!! trans('menu.messages') !!}</a></li>
                        <li class="setting-menu dropdown dropdown-user pointer {!! ($pageNo == 10 || $pageNo == 11 || $pageNo == 12) ? 'active' : ''!!}">
                            <a class="dropdown-toggle" dropdown-toggle = "dropdown" data-hover="dropdown" data-close-others="true">{!! trans('menu.interviews') !!}</a>
                            <ul class="dropdown-menu">
                                <li class="{!! ($pageNo == 10) ? 'active' : ''!!}"><a href="{!! URL::route('company.interview.face') !!}">{!! trans('menu.face_interview') !!}</a></li>
                                <li class="{!! ($pageNo == 11) ? 'active' : ''!!}"><a href="{!! URL::route('company.interview.video') !!}">{!! trans('menu.video_interview') !!}</a></li>
                                <li class="{!! ($pageNo == 12) ? 'active' : ''!!}"><a href="{!! URL::route('company.interview.shared') !!}">{!! trans('menu.shared_interview') !!}</a></li>
                            </ul>
                        </li>
                        @if (Session::get('member_id') == -1)
                        <li class="{!! ($pageNo == 13) ? 'active' : ''!!}"><a href="{!! URL::route('company.setting' )!!}">{!! trans('menu.setting') !!}</a></li>
                        @endif
                    @elseif (Session::has('agency_id'))
                    	<li class="{!! ($pageNo == 3) ? 'active' : ''!!}"><a href="{!! URL::route('agency.dashboard') !!}">{!! trans('menu.dashboard') !!}</a></li>
                        <li class="setting-menu dropdown dropdown-user pointer {!! ($pageNo == 1 || $pageNo == 2) ? 'active' : ''!!}">
                            <a class="dropdown-toggle" dropdown-toggle = "dropdown" data-hover="dropdown" data-close-others="true">{!! trans('menu.jobs') !!}</a>
                            <ul class="dropdown-menu">
                                <li class="{!! ($pageNo == 1) ? 'active' : ''!!}"><a href="{!! URL::route('agency.job.add') !!}">{!! trans('menu.post_job') !!}</a></li>
                                <li class="{!! ($pageNo == 2) ? 'active' : ''!!}"><a href="{!! URL::route('agency.job.myjobs' )!!}">{!! trans('menu.my_jobs') !!}</a></li>
                            </ul>
                        </li>
                        <li class="setting-menu dropdown dropdown-user pointer {!! ($pageNo == 5 || $pageNo == 6) ? 'active' : ''!!}">
                            <a class="dropdown-toggle" dropdown-toggle = "dropdown" data-hover="dropdown" data-close-others="true">People</a>
                            <ul class="dropdown-menu">
                                <li class="{!! ($pageNo == 5) ? 'active' : ''!!}"><a href="{!! URL::route('agency.user.find' )!!}">{!! trans('menu.find_people') !!}</a></li>
                                <li class="{!! ($pageNo == 6) ? 'active' : ''!!}"><a href="{!! URL::route('agency.user.applied' )!!}">{!! trans('menu.applied_people') !!}</a></li>
                                <li class="{!! ($pageNo == 8) ? 'active' : ''!!}"><a href="{!! URL::route('agency.user.shared' )!!}">{!! trans('menu.shared_people') !!}</a></li>
                            </ul>
                        </li>
                    	<li class="{!! ($pageNo == 7) ? 'active' : ''!!}"><a href="{!! URL::route('agency.message.list' )!!}">{!! trans('menu.messages') !!}</a></li>
                        <li class="setting-menu dropdown dropdown-user pointer {!! ($pageNo == 10 || $pageNo == 11 || $pageNo == 12) ? 'active' : ''!!}">
                            <a class="dropdown-toggle" dropdown-toggle = "dropdown" data-hover="dropdown" data-close-others="true">{!! trans('menu.interviews') !!}</a>
                            <ul class="dropdown-menu">
                                <li class="{!! ($pageNo == 10) ? 'active' : ''!!}"><a href="{!! URL::route('agency.interview.face') !!}">{!! trans('menu.face_interview') !!}</a></li>
                                <li class="{!! ($pageNo == 11) ? 'active' : ''!!}"><a href="{!! URL::route('agency.interview.video') !!}">{!! trans('menu.video_interview') !!}</a></li>
                                <li class="{!! ($pageNo == 12) ? 'active' : ''!!}"><a href="{!! URL::route('agency.interview.shared') !!}">{!! trans('menu.shared_interview') !!}</a></li>
                            </ul>
                        </li>
                    	<li class="{!! ($pageNo == 13) ? 'active' : ''!!}"><a href="{!! URL::route('agency.company.index') !!}">{!! trans('menu.companies') !!}</a></li>
                    @else
                        <li class="{!! ($pageNo == 98) ? 'active' : ''!!}">
                        	<a href ="{!! URL::route('company.auth.login') !!}">{!! trans('menu.sign_in') !!}</a>
                        </li>
                        <li class="{!! ($pageNo == 99) ? 'active' : ''!!}">
                        	<a href="{!! URL::route('company.auth.signup') !!}">{!! trans('menu.register') !!}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@stop

@yield('content')

@section('footer')
<div class="pre-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 pre-footer-col">
              <h2>{!! trans('footer.company_info') !!}</h2>
              <ul>
                  <li><a href="{!! URL::route('user.aboutUs') !!}" target="_blank">{!! trans('footer.about_us') !!}</a></li>
                  <li><a href="{!! URL::route('user.consumerBasic') !!}" target="_blank">{!! trans('footer.consumer_basic') !!}</a></li>
                  <li><a href="{!! URL::route('user.consumers') !!}" target="_blank">{!! trans('footer.consumers') !!}</a></li>
                  <li><a href="{!! URL::route('user.featureBusinessSmall') !!}" target="_blank">{!! trans('footer.feature_business') !!}</a></li>
                  <li><a href="{!! URL::route('user.featureBusiness') !!}" target="_blank">{!! trans('footer.for_business') !!}</a></li>
              </ul>
            </div>

            <div class="col-sm-4 pre-footer-col">
                <h2>{!! trans('common.contact_info') !!}</h2>
                    <address class="margin-bottom-40">
                    Internet Group Finland Oy<br>
                    Henry Fordin Katu 6<br>
                    00150 Helsinki, Finland<br>
                    {!! trans('menu.phone') !!} : +358 45 146 3755<br>
                    {!! trans('menu.email') !!} : Yritys@jobilla.fi<br>
                    </address>
            </div>
            <div class="col-sm-4 pre-footer-col">
                <div class="pre-footer-subscribe-box pre-footer-subscribe-box-vertical">
                    <h2>{!! trans('menu.newsletter') !!}</h2>
                    <p>{!! trans('menu.msg_01') !!}</p>

                    <div class="input-group">
                        <input type="text" placeholder="{!! trans('menu.msg_02') !!}" class="form-control" id="js-text-subscriber-email">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" id="js-btn-subscriber">{!! trans('menu.subscriber') !!}</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 padding-top-10">
            2015 &copy; Finternet-Group. {!! trans('menu.msg_03') !!}.
            </div>
            <div class="col-md-6 col-sm-6">
                <ul class="social-footer list-unstyled list-inline pull-right">
                    <li><a href="https://www.facebook.com/jobilla.jobs" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.linkedin.com/company/9221291?trk=tyah&trkInfo=idx%3A1-1-1%2CtarId%3A1424145037259%2Ctas%3Afinternet" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://twitter.com/finternetgroup" target="_blank"><i class="fa fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-69064462-1', 'auto');
      ga('send', 'pageview');

    </script>

	{!! Html::script('/assets/metronic/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
    {!! Html::script('/assets/metronic/assets/frontend/layout/scripts/back-to-top.js') !!}
    {!! Html::script('/assets/metronic/assets/frontend/layout/scripts/layout.js') !!}

    {!! Html::script('/assets/metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! Html::script('/assets/metronic/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') !!}
    {!! Html::script('/assets/metronic/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('/assets/metronic/assets/global/scripts/metronic.js') !!}
    {!! Html::script('/assets/metronic/assets/admin/pages/scripts/components-pickers.js') !!}
    {!! Html::script('/assets/metronic/assets/global/plugins/select2/select2.min.js') !!}
    {!! Html::script('/assets/metronic/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('/assets/metronic/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}

    {!! Html::script('/assets/js/star-rating.min.js') !!}

    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initUniform();
            Layout.initTwitter();
            Metronic.init();
            ComponentsPickers.init();
        });
    </script>
@stop
