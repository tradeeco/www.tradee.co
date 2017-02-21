@extends('layout.frontend')
@section('custom-styles')
{{--    {!! Html::style('frontend/plugins/owl-carousel/owl-carousel/owl.carousel.css?'.time()) !!}--}}

@stop
@section('body')
    <div class="container content">
        @include('partial/alert_message')
        <div class="tab-v2">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#watching" data-toggle="tab" aria-expanded="false">Watching</a></li>
                <li><a href="#interested" data-toggle="tab" aria-expanded="false">(##) Interested</a></li>
                <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="false">(##) Shortlisted</a></li>
                <li class=""><a href="#messages-1" data-toggle="tab" aria-expanded="false">(##) Selected</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="watching">
                    <h4>Heading Sample 1</h4>
                    <p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum <strong>ivamus imperdiet</strong> condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque <strong>fermentum vivamus</strong> imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac felis consectetur id. Donec eget orci metusvivamus imperdiet.</p>
                </div>
                <div class="tab-pane fade in" id="profile-1">
                    <img alt="" class="pull-left lft-img-margin img-width-200" src="assets/img/main/img17.jpg">
                    <h4>Heading Sample 2</h4>
                    <p>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, <strong>ac adipiscing nunc.</strong> Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac <strong>interdum ullamcorper.</strong></p>
                </div>
                <div class="tab-pane fade in" id="messages-1">
                    <h4>Heading Sample 3</h4>
                    <p><img alt="" class="pull-right rgt-img-margin img-width-200" src="assets/img/main/img21.jpg"> <strong>Vivamus imperdiet condimentum diam, eget placerat felis consectetur id.</strong> Donec eget orci metus, Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, consectetur id. Donec eget orci metus, ac adipiscing nunc. <strong>Pellentesque fermentum</strong>, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

    {{--{!! Html::script('frontend/js/pages/job.js?'.time()) !!}--}}
@endsection