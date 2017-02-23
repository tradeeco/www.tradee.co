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
                @if (!$job->watching && $job->user != Auth::user())
                    <a href="javascript:void(0)" class="btn btn-primary btn-lg rounded" id="move_watching">move to WATCHLIST</a>
                @endif
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
        <div class="col-md-12">
            <h2 class="label-color margin-bottom-30">Job by:</h2>
        </div>
        <div class="col-md-6 margin-bottom-40">
            <div class="job-user profile">
                <img src="{{ userImageSmall($job->user) }}" class="rounded-x pull-left margin-right-20" style="width: 150px; height: 150px;">
                <div class="name-location">
                    <h3 class="margin-bottom-15">{{ $job->user->first_name }}</h3>
                    <h3 class="label-color margin-bottom-15">Rating - X X X X </h3>
                    <p>{{ $job->user->userProfile->short_bio }}</p>
                </div>
            </div>
        </div>
            <div class="col-md-6">
                <a href="javascript:void(0)" class="btn btn-primary btn-lg rounded-x pull-right text-uppercase" style="width: 150px; height: 150px; font-size: 25px; padding: 45px 15px; line-height: 27px;"> Express<br/>Interest</a>
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
                @include('job/question_answer/question_partial', ['jobQuestion' => $jobQuestion])
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
        Job.initShow();
    </script>
@endsection