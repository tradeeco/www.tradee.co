@extends('layout.frontend')
@section('custom-styles')
    @if (Auth::check())
    {!! Html::style('backend/css/plugins/dropzone/basic.css?'.time()) !!}
    {!! Html::style('backend/css/plugins/dropzone/dropzone.css?'.time()) !!}
    @endif
@stop
@section('body')
    <div class="container home content">
        <h1 class="text-center margin-bottom-35">FIND OR POST A JOB</h1>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="profile-body margin-bottom-20">
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#post_job" aria-expanded="true">POST JOBS</a></li>
                            <li class=""><a data-toggle="tab" href="#passwordTab" aria-expanded="false">SEARCH JOBS</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="post_job" class="panel-body tab-pane fade active in">
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
                                            {{ Form::select('category_id', $categories, null, ['class' => 'form-control input-lg rounded']) }}
                                        </div>
                                        <div class="col-md-4">
                                            <label>Area / Suburb</label>
                                            {{ Form::select('area_suburb_id', $locations, null, ['class' => 'form-control input-lg rounded']) }}
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

                                <div id="passwordTab" class="panel-body tab-pane fade">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                {{ Form::select('category_id', $categories, null, ['class' => 'form-control input-lg rounded']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::select('area_suburb_id', $locations, null, ['class' => 'form-control input-lg rounded']) }}
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary rounded btn-lg">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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