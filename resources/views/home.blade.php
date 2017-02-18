@extends('layout.frontend')
@section('custom-styles')
    @if (Auth::check())
    {!! Html::style('backend/css/plugins/dropzone/basic.css?'.time()) !!}
    {!! Html::style('backend/css/plugins/dropzone/dropzone.css?'.time()) !!}
    @endif
@stop
@section('body')
    <section class="home-section vertical-center">
        <div class="container home-container content-sm">
            <h1 class="text-center margin-bottom-100 color-white">FIND OR POST A JOB</h1>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="profile-body margin-bottom-20">
                        <div class="tab-v1">
                            <ul class="nav nav-justified nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#search_job" aria-expanded="false">SEARCH JOBS</a></li>
                                <li><a data-toggle="tab" href="#post_job" aria-expanded="true">POST JOBS</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="search_job" class="panel-body tab-pane fade active in">
                                    {!! Form::open(['url' => route('jobs.index'), 'id' => 'search_job', 'method' => 'GET']) !!}
                                    <div class="row">
                                        <div class="col-md-5">
                                            {{ Form::select('category', $categories, null, ['class' => 'form-control input-lg rounded']) }}
                                        </div>
                                        <div class="col-md-5 padding-left-5">
                                            {{ Form::select('location', $locations, null, ['class' => 'form-control input-lg rounded']) }}
                                        </div>
                                        <div class="col-md-2" style="padding-left: 0">
                                            <button type="submit" class="btn btn-primary rounded btn-lg btn-block">Search</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div id="post_job" class="panel-body tab-pane fade in">
                                    @if (Auth::check())
                                    {!! Form::open(['url' => route('jobs.store'), 'class' => 'create-job', 'data-parsley-validate', 'id' => 'create_job']) !!}
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        {{ Form::label('title', 'Job Title') }}
                                        {{ Form::text('title', null, array('class' => 'input-lg form-control rounded', 'id' => 'title', 'required' => 'true')) }}
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                {{ Form::label('category', 'Category') }}
                                                {{ Form::select('category_id', $categories1, null, ['class' => 'form-control input-lg rounded']) }}
                                            </div>
                                            <div class="col-md-4">
                                                <label>Area / Suburb</label>
                                                {{ Form::select('area_suburb_id', $locations1, null, ['class' => 'form-control input-lg rounded']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                        {{ Form::label('description', 'Short Description') }}
                                        <textarea type="text" class="form-control input-lg rounded" name="description" ></textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('photo_ids') ? ' has-error' : '' }}">
                                        <label>Add Photos</label>
                                        <div class="dropzone-previews dropzone" id="dropzone_preview" data-url="{{ URL::route('jobs.upload_photo') }}"></div>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('photo_ids') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary rounded btn-lg">POST</button>
                                    </div>

                                    {!! Form::close() !!}
                                    @else
                                        <h2 class="text-center color-white margin-bottom-15">Oops, you are not logged in!</h2>
                                        <h3 class="text-center color-white margin-bottom-20"><b>Sign In below!</b></h3>
                                        <div class="row">
                                            <div class="col-md-8 col-md-offset-2">
                                                @include('partial/login_form')
                                            </div>
                                        </div>
                                        <h3 class="text-center color-white">Dont have an account? Its <b>FREE!</b></h3>
                                        <h3 class="text-center color-white margin-bottom-20"><b>Sign Up below!</b></h3>
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-1">
                                                @include('partial/register_form')
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=== Service Block ===-->
    <div class="container content-sm how-works-container" id="how_works">
        <h2 class="text-center text-uppercase">How TRADEE works</h2>
        <div class="row">
            <div class="col-md-4 content-boxes-v6 md-margin-bottom-50">
                <div class="image-block">
                <img src="img/post-job.png" class="full-width"/>
                </div>
                <h2 class="text-uppercase margin-bottom-10">POST A JOB</h2>
                <p>TRADERS post and describe a job <br/>they need help with  using the <br/> TRADEE platform for FREE.</p>
            </div>
            <div class="col-md-4 content-boxes-v6 md-margin-bottom-50">
                <div class="image-block">
                <img src="img/find-job.png" class="full-width" style="width: 120px;"/>
                </div>
                <h2 class="text-uppercase margin-bottom-10">FIND A JOB</h2>
                <p>TRADEE’s are notified of jobs in their area or may search for jobs. TRADEE’s may express interest in a job for FREE.</p>
            </div>
            <div class="col-md-4 content-boxes-v6">
                <div class="image-block">
                <img src="img/get-done.png" class="full-width"  style="width: 120px;"/>
                </div>
                <h2 class="text-uppercase margin-bottom-10">GET IT DONE</h2>
                <p>TRADERS can view all the TRADEE’s that are interested, and may shortlist a selection and share contact details.</p>
            </div>
        </div><!--/row-->
    </div><!--/container-->

    <div class="container content-sm payment-container">
        <h2 class="text-center text-uppercase">Payment</h2>
        <div class="row margin-bottom-40">
            <div class="col-md-5 col-md-offset-1 text-center">
                <div class="image-block margin-bottom-20">
                    <img src="img/pricing-trader.png" />
                </div>
                <h2 class="text-uppercase margin-bottom-25">TRADER</h2>
                <p>To post a job on TRADEE is <br/> <b>completely free.</b></p>
            </div>
            <div class="vertical-divider" style="left: 50%; bottom: 0"></div>
            <div class="col-md-5 text-center">
                <div class="image-block margin-bottom-20">
                    <img src="img/pricing-tradee.png" />
                </div>
                <h2 class="text-uppercase margin-bottom-25">TRADEE</h2>
                <p>To search or view is free. You are only <br/> <b>charged per lead</b><br/> you get when you are interested in a job.</p>
            </div>
        </div><!--/row-->
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#" class="btn btn-primary rounded btn-lg" style="font-size: 16px;">Know more</a>
            </div>
        </div>
    </div><!--/container-->

    <div class="container-fluid content why-trade-container space-lg-hor">
        <h2 class="text-center text-uppercase">WHY TRADEE</h2>
        <div class="row">
            <div class="col-md-4 content-boxes-v6 md-margin-bottom-50">
                <h2 class="text-uppercase margin-bottom-10">Save Your Time</h2>
                <p>Post a job and those who <br/> can help will come to you and <br/> not vice versa.</p>
            </div>
            <div class="col-md-4 content-boxes-v6 md-margin-bottom-50">
                <h2 class="text-uppercase margin-bottom-10">Easy To Find Help</h2>
                <p>One platform that is simple <br/> and easy  to use for all <br/> your <b>TRADEE</b> jobs.</p>
            </div>
            <div class="col-md-4 content-boxes-v6">
                <h2 class="text-uppercase margin-bottom-10">Transparency</h2>
                <p>Safety and security is key. <br/> Know exactly who is working <br/> on your job.</p>
            </div>
        </div><!--/row-->
    </div>
    <div class="bg-color-main margin-bottom-5">
        <div class="container content reviews-container">
            <h2 class="text-center text-uppercase color-white">REVIEWS</h2>
            <div class="row">
                <div class="col-md-4 content-boxes-v6 md-margin-bottom-50">
                    <div class="image-block">
                        <img src="img/home-review1.png" class="full-width"/>
                    </div>
                    <h3 class="margin-bottom-10 color-white">John Doe</h3>
                    <p class="color-white">"Review remarks are great"</p>
                </div>
                <div class="col-md-4 content-boxes-v6 md-margin-bottom-50">
                    <div class="image-block">
                        <img src="img/home-review1.png" class="full-width"/>
                    </div>
                    <h3 class="margin-bottom-10 color-white">John Doe</h3>
                    <p class="color-white">"Review remarks are great"</p>
                </div>
                <div class="col-md-4 content-boxes-v6">
                    <div class="image-block">
                        <img src="img/home-review1.png" class="full-width"/>
                    </div>
                    <h3 class="margin-bottom-10 color-white">John Doe</h3>
                    <p class="color-white">"Review remarks are great"</p>
                </div>
            </div><!--/row-->
        </div>
    </div>
    @endsection

    @section('custom-scripts')
        @if (Auth::check())
        {!! Html::script('backend/js/plugins/dropzone/dropzone.js') !!}
    {!! Html::script('frontend/js/pages/home.js?'.time()) !!}
    <script>
        Home.init();
    </script>
    @endif
@endsection