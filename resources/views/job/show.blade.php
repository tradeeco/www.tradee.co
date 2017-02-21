@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/plugins/owl-carousel/owl-carousel/owl.carousel.css?'.time()) !!}
    {!! Html::style('frontend/css/pages/profile.css?'.time()) !!}

@stop
@section('body')
    <div class="container content">
        @include('partial/alert_message')

        <div class="row" id="job_info" data-id="{{ $job->id }}">
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
                <h3 class="label-color">{{ $job->category->name }}</h3>
                <h3 class="label-color">{{ $job->areaSuburb->name }}</h3>
                <p>{{ $job->description }}</p>
            </div>
        </div>
        @if (Auth::check() && $job->user->id == Auth::user()->id)
        <div class="tab-v2">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home-1" data-toggle="tab" aria-expanded="false">(##) Interested</a></li>
                <li class=""><a href="#profile-1" data-toggle="tab" aria-expanded="false">(##) Shortlisted</a></li>
                <li class=""><a href="#messages-1" data-toggle="tab" aria-expanded="false">(##) Selected</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="home-1">
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
        @else
        <div class="col-md-12 margin-bottom-40">
            <div class="job-user profile">
                <h2 class="label-color margin-bottom-30">Job by:</h2>
                <img src="{{ userImageSmall($job->user) }}" class="rounded-x pull-left margin-right-20">
                <div class="name-location">
                    <h3 class="margin-bottom-15">{{ $job->user->first_name }}</h3>
                    <h3 class="label-color margin-bottom-15">Rating - X X X X </h3>
                    <p>{{ $job->user->userProfile->short_bio }}</p>
                </div>
            </div>
        </div>
        @endif
        <div class="row margin-bottom-20">
            <div class="col-md-6">
                <h4 class="label-color">Posted: {{ Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}</h4>
            </div>
            <div class="col-md-6">
                <h4 class="label-color">Views: XXX</h4>
            </div>
        </div>
        <div class="row">
            <h3 class="margin-left-10">Ask a question</h3>
            {!! Form::open(['url' => route('job_questions.store'), 'class' => 'question-form', 'id' => 'question_form']) !!}
            <div class="col-md-5">
                {{ Form::text('content', old('content'), ['class' => 'form-control input-lg rounded', 'placeholder' => 'Ask any']) }}
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-lg rounded">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="profile job-questions">
            @foreach ($job->jobQuestions as $jobQuestion)
            <div class="media media-v2 margin-bottom-20">
                <a class="pull-left" href="#">
                    <img class="media-object rounded-x" src="{{ userImageSmall($jobQuestion->user) }}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        <strong><a href="#">{{ $jobQuestion->user->first_name }}</a></strong>
                        <small>{{ $jobQuestion->created_at->diffForHumans() }}</small>
                    </h4>
                    <p>{{ $jobQuestion->content }}</p>
                    {{--<ul class="list-inline results-list pull-left">--}}
                        {{--<li><a href="#">5 Likes</a></li>--}}
                        {{--<li><a href="#">1 Share</a></li>--}}
                    {{--</ul>--}}
                    <ul class="list-inline pull-right">
                        <li><a href="javascript:void(0)" id="reply_question"><i class="expand-list rounded-x fa fa-reply"></i></a></li>
                        {{--<li><a href="#"><i class="expand-list rounded-x fa fa-heart"></i></a></li>--}}
                        {{--<li><a href="#"><i class="expand-list rounded-x fa fa-retweet"></i></a></li>--}}
                    </ul>

                    <div class="clearfix"></div>
                    <div class="row">
                    {!! Form::open(['url' => route('job_questions.answers.store', $jobQuestion->id), 'class' => 'answer-form fade in', 'id' => 'answer_form', 'data-question_id' => $jobQuestion->id]) !!}
                        <div class="col-md-5">
                            {{ Form::text('content', old('content'), ['class' => 'form-control rounded', 'placeholder' => 'Answer']) }}
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary rounded">Submit</button>
                            <a href="javascript:void(0)" class="btn btn-default rounded" id="reply_cancel">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                    </div>
                    <div class="job-answers">
                    @foreach ($jobQuestion->jobAnswers as $jobAnswer)
                    <div class="media media-v2">
                        <a class="pull-left" href="#">
                            <img class="media-object rounded-x" src="{{ userImageSmall($jobAnswer->user) }}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <strong><a href="#">{{ $jobAnswer->user->first_name }}</a></strong>
                                <small>{{ $jobAnswer->created_at->diffForHumans() }}</small>
                            </h4>
                            <p>{{ $jobAnswer->content }}</p>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div><!--/end media media v2-->
            @endforeach
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/plugins/owl-carousel/owl-carousel/owl.carousel.js?'.time())  !!}
    {!! Html::script('frontend/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js?'.time())  !!}

    {!! Html::script('frontend/js/pages/job.js?'.time()) !!}
    <script>
        Job.init();
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
            });
            jQuery(".prev-v2").click(function(){
                owl1.trigger('owl.prev');
            });
        });
    </script>
@endsection