@extends('layout.frontend')
@section('custom-styles')
    <style>
        .wrapper {
            background: transparent;
        }
    </style>
@stop
@section('custom-styles')
@stop
@section('body')
    <section class=" vertical-center" style="min-height: 750px;">
    <div class="container content" >
        <div class="row">
            <div class="col-md-8 col-md-offset-2 margin-top-20 text-center">
                <h1 class="text-center margin-bottom-25 color-white">Sign up for <span class="color-main">FREE</span></h1>
                @include('partial/register_form')
            </div>
        </div>
</div>
    </section>
@endsection

@section('custom-scripts')
    {!! Html::script('frontend/plugins/backstretch/jquery.backstretch.min.js?'.time()) !!}
    <script>
        $.backstretch([
            "img/signup-bg.jpg",
        ], {
            fade: 1000,
            duration: 7000
        });
    </script>
@endsection