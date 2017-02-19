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
    <section style="min-height: 750px; background-color: rgba(0,0,0,0.3);">
        <div class="container content" >
            <div class="row">
                <h1 class="color-white margin-bottom-30 font-weight-400">OUR STORY</h1>
                <h3 class="color-white margin-bottom-20" style="font-weight: 500;">Late 2016 - Early 2017</h3>
                <h4 class="color-white margin-bottom-20" style="line-height: 28px; letter-spacing: 2px;">
                    During late 2016, TRADEE founders Alex and Nik had an interesting conversation <br/>
                    about the difficulty Nik’s friends had in finding Tradesman work and how <br/>
                     Alex was having difficulty looking for Tradesman to hire. With the knowledge <br/>
                    and experience in digital business behind them, Alex and Nik later agreed <br/>
                    to working with one-another in getting such a platform to market and <br/>
                    soon after Founded - Tradee Limited.
                </h4>
                <h4 class="color-white margin-bottom-20" style="line-height: 28px; letter-spacing: 2px;">
                    Shortly after the company was founded in January 2017, TRADEE received <br/>
                    the Seed Round Investment it required in order to develop its first version <br/>
                    of the platform and take it to market.
                </h4>
                <h4 class="color-white margin-bottom-30" style="line-height: 28px; letter-spacing: 2px;">
                    After securing Investment, Co-Founders Alex and Nik put together an <br/>
                    Official Advisory Board, consisting of 3 -4 relevant industry Executives, <br/>
                    boosting their networks and accelerating direction.
                </h4>
                <h3 class="color-white margin-bottom-20" style="font-weight: 500;">
                    Mid 2017 - Present
                </h3>
                <h4 class="color-white margin-bottom-20" style="line-height: 28px; letter-spacing: 2px;">
                    By Mid-2017, TRADEE’S first version of the platform had been released to <br/>
                    market, in which the company’s aim is to engage users and work towards <br/>
                    optimizing the system to be as user friendly, efficient and as "ironed out" <br/>
                    as possible. TRADEE hopes to grow its user base, listen to its user’s <br/>
                    feedback and work towards creating the perfect platform for connecting <br/>
                    trade skill individuals with relevant and local work.
                </h4>
                <h4 class="color-white margin-bottom-20" style="line-height: 28px; letter-spacing: 2px;">
                    TRADEE is currently undergoing some exciting Partnerships with relevant <br/>
                    Industry businesses to help provide more value to our users and help <br/>
                    actualize our mission.
                </h4>
                <a href="javascript:void(0)" class="color-main underline">Watch the space for more!</a>
            </div>
        </div>
    </section>
@endsection

@section('custom-scripts')
    {!! Html::script('frontend/plugins/backstretch/jquery.backstretch.min.js?'.time()) !!}
    <script>
        $.backstretch([
            "img/story-bg.jpg",
        ], {
            fade: 1000,
            duration: 7000
        });
    </script>
@endsection