@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/plugins/owl-carousel/owl-carousel/owl.carousel.css?'.time()) !!}
    {!! Html::style('frontend/css/pages/profile.css?'.time()) !!}

@stop
@section('body')
    <div class="container content">
        <div class="row">
            <div class="col-md-6" id="slider">
                <div class="row">
                    <div class="col-sm-12 margin-bottom-20" id="carousel-bounding-box">
                        <div class="carousel slide" id="myCarousel">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                @foreach ($job->jobPhotos as $key => $photo)
                                <div class="{{ $key == 0 ? 'active' : '' }} item" data-slide-number="{{ $key }}">
                                    <img src="{{ jobPhotoSrc($photo) }}" class="full-width" style="height: 350px;"></div>
                                @endforeach
                            </div>
                            <!-- Carousel nav -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                    <div class="owl-carousel-v2 owl-carousel-style-v1 margin-bottom-20">
                        <div class="owl-slider-v2">
                            @foreach ($job->jobPhotos as $key => $photo)
                            <div class="item">
                                <img src="{{ jobPhotoSrc($photo) }}" style="height: 120px" class="full-width" id="carousel-selector-{{ $key }}"></div>
                            @endforeach

                        </div>
                        <div class="owl-navigation">
                            <div class="customNavigation">
                                <a class="owl-btn prev-v2"><i class="fa fa-angle-left"></i></a>
                                <a class="owl-btn next-v2"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div><!--/navigation-->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="label-color">{{ $job->title }}</h2>
                <h2 class="label-color">{{ $job->category->name }}</h2>
                <h2 class="label-color">{{ $job->areaSuburb->name }}</h2>
                <p>{{ $job->description }}</p>
            </div>
        </div>
        <div class="col-md-12 margin-bottom-40">
            <div class="job-user profile">
                <h2 class="label-color margin-bottom-30">Job by:</h2>
                <img src="{{ userImageSmall($job->user) }}" class="rounded-x pull-left margin-right-20">
                <div class="name-location">
                    <h3 class="margin-bottom-15">{{ $job->user->first_name . ' ' . $job->user->last_name }}</h3>
                    <h3 class="label-color margin-bottom-15">Rating - X X X X </h3>
                    <p>{{ $job->user->userProfile->short_bio }}</p>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-20">
            <div class="col-md-6">
                <h4 class="label-color">Posted: {{ Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}</h4>
            </div>
            <div class="col-md-6">
                <h4 class="label-color">Views: XXX</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h3>Ask a question</h3>
                <input type="text" placeholder="Ask any" class="form-control input-lg rounded">
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/plugins/owl-carousel/owl-carousel/owl.carousel.js?'.time())  !!}
    {{--{!! Html::script('frontend/js/pages/home.js?'.time()) !!}--}}
    <script>
//        Home.init();
        jQuery(document).ready(function($) {

            $('#myCarousel').carousel({
                interval: 5000
            });

            //Handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function () {
                var id_selector = $(this).attr("id");
                try {
                    var id = /-(\d+)$/.exec(id_selector)[1];
                    console.log(id_selector, id);
                    jQuery('#myCarousel').carousel(parseInt(id));
                } catch (e) {
                    console.log('Regex failed!', e);
                }
            });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function (e) {
                var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
            });

            var owl1 = jQuery(".owl-slider-v2").owlCarousel({
                itemsDesktop : [1600,3],
                itemsDesktopSmall : [900,2],
                itemsTablet: [600,2],
                itemsMobile : [479,2],
                slideSpeed: 1000
            });
            jQuery(".next-v2").click(function(){
                owl1.trigger('owl.next');
            })
            jQuery(".prev-v2").click(function(){
                owl1.trigger('owl.prev');
            })
        });
    </script>
@endsection