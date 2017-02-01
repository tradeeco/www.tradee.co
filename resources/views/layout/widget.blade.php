@extends('layout.main')
    @section('styles')
        {!! Html::style('/assets/metronic/assets/frontend/layout/css/style.css') !!}
        {!! Html::style('/assets/metronic/assets/frontend/pages/css/style-revolution-slider.css') !!}
        {!! Html::style('/assets/metronic/assets/frontend/layout/css/style-responsive.css') !!}
        {!! Html::style('/assets/metronic/assets/frontend/layout/css/themes/blue.css') !!}
        {!! Html::style('/assets/metronic/assets/frontend/layout/css/custom.css') !!}
        {!! Html::style('/assets/css/style_bootstrap.css') !!}
        {!! Html::style('/assets/css/star-rating.min.css') !!}
        
        {!! Html::style('/assets/css/style_user.css') !!}
        {!! Html::style('/assets/css/style_company.css') !!}
        {!! Html::style('/assets/css/style_widget.css') !!}

        @include('css.env')
    @stop

    @section('body')
            @section('main')

            @stop
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

        {!! Html::script('/assets/js/star-rating.min.js') !!}
    	{!! Html::script('/assets/metronic/assets/frontend/layout/scripts/back-to-top.js') !!}
    	{!! Html::script('/assets/metronic/assets/frontend/layout/scripts/layout.js') !!}

        <script type="text/javascript">
            jQuery(document).ready(function() {
                Layout.init();
                Layout.initTwitter();
                Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
                Layout.initNavScrolling();
            });
        </script>
    @stop
@stop