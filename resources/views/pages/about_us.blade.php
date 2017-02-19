@extends('layout.frontend')
@section('custom-styles')
    <style>
        .wrapper {
            background: transparent;
        }
        h2.title-v2 { margin-bottom: 50px; }
        h2.title-v2:after {
            width: 120px;
            bottom: -25px;
            background: #e1e1e1;
        }
        h2.title-v2.text-right:after {
            width: 120px;
            right: 0;
            left: auto;
        }
    </style>
@stop
@section('custom-styles')
@stop
@section('body')
    <section class="bg-color-main about-container">
        <div class="container content text-center">
            <div class="row">
                <h1 class="color-white margin-bottom-30">TRADEE</h1>
                <h3 class="color-white margin-bottom-50">Our mission is to support every community in <br/> New Zealand in working together.</h3>
                <h2 class="color-white text-center text-uppercase ">VALUES</h2>
                <div class="row">
                    <div class="col-md-4 content-boxes-v6 md-margin-bottom-50 padding-top-15">
                        <div class="image-block">
                            <img src="img/aboutus-1.png"/>
                        </div>
                        <h2 class="text-uppercase margin-bottom-20 color-white">Sustainability</h2>
                        <h4 class="color-white font-weight-400" style="line-height: 29px;">We care very much for <br/>both ecological and <br/> sociological environments <br/> of New Zealand and <br/> the World.</h4>
                    </div>
                    <div class="col-md-4 content-boxes-v6 md-margin-bottom-50 padding-top-15">
                        <div class="image-block">
                            <img src="img/aboutus-2.png"/>
                        </div>
                        <h2 class="text-uppercase margin-bottom-20 color-white">Integrity</h2>
                        <h4 class="color-white" style="line-height: 29px;">We beleive in honest,<br/> transparent and reliable <br/> work ethic and business. <br/> We are certain our work <br/> reflects this.</h4>
                    </div>
                    <div class="col-md-4 content-boxes-v6 padding-top-15">
                        <div class="image-block">
                            <img src="img/aboutus-3.png"/>
                        </div>
                        <h2 class="text-uppercase margin-bottom-20 color-white">Communities</h2>
                        <h4 class="color-white" style="line-height: 29px;">As one of our key <br/> commitments, we hope <br/> to provide more abilities <br/> and encouragement amongst <br/> community members.</h4>
                    </div>
                </div><!--/row-->
                <a href="javascript:void(0)" class="color-main underline">Watch the space for more!</a>
            </div>
        </div>
    </section>
    <section>
        <div class="container content">
            <div class="row">
                <div class="col-md-6">
                    <h2 style="color: #363636;">Meet the </h2>
                    <h2 class="title-v2 color-main margin-bottom-50">Team</h2>
                    <p class="margin-bottom-30">In order to acheive great things,<br/> you need great people.</p>
                    <div class="margin-bottom-50">
                        <button class="btn btn-primary btn-lg rounded">meet the team</button>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <img src="img/aboutus-team1.png" class="full-width"/>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 text-right">
                    <div class="row margin-bottom-50">
                        <div class="col-md-9 col-md-offset-3">
                            <img src="img/aboutus-team2.png" class="full-width"/>
                        </div>
                    </div>
                    <h2 style="color: #363636;" class="text-right">Read our </h2>
                    <h2 class="title-v2 color-main text-right margin-bottom-50">Story</h2>
                    <p class="margin-bottom-30 text-right">Founded in late 2016, Tradee’s roots <br/> fall deep within the ....</p>
                    <a href="{{ URL::route('pages.story') }}" class="btn btn-primary btn-lg rounded">coming soon</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-scripts')
    {!! Html::script('frontend/plugins/backstretch/jquery.backstretch.min.js?'.time()) !!}
@endsection