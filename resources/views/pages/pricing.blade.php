@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/css/pages/page_coming_soon_v5.css?'.time()) !!}
    <style>
        .wrapper {
            background: transparent;
        }
    </style>
@stop
@section('custom-styles')
@stop
@section('body')
    <div class="coming-soon-v5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-7 col-xs-8 col-2xs-12">
                    <img class="margin-bottom-50" src="img/logo.png" alt="logo">

                    <h1 class="margin-bottom-20">Coming Soon</h1>
                    <p class="margin-bottom-50">Lorem ipsum dolor sit amet, consectetur adipisic elit, sed do eiusmod tempor incididunt labore.</p>

                    <!-- Coming Soon Plugn -->
                    <div class="coming-soon-plugin margin-bottom-80">
                        <div id="defaultCountdown"></div>
                    </div>

                </div>
            </div>
            {{--<p class="copyright"> 2016 &copy; ALL Rights Reserved. Unify Template by <a href="http://htmlstream.com/" target="_blank" class="color-light">Htmlstream</a></p>--}}
        </div>
    </div>
@endsection

@section('custom-scripts')
    {!! Html::script('frontend/plugins/countdown/jquery.plugin.js') !!}
    {!! Html::script('frontend/plugins/countdown/jquery.countdown.js') !!}
    {!! Html::script('frontend/js/pages/page_coming_soon.js?'.time()) !!}
    <script>
        jQuery(document).ready(function() {
            App.init();
            PageComingSoon.initPageComingSoon();

            $('body').css('margin-top', Number($(document).height() - $('.coming-soon-v5').height())/2);
            $(window).resize(function() {
                $('body').css('margin-top', Number($(document).height() - $('.coming-soon-v5').height())/2);
            });
        });
    </script>
@endsection