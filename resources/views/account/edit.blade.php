@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h2 class="margin-bottom-35">YOUR TRADEE PROFILE</h2>
        @include('partial/alert_message')
        <div class="row">
            {!! Form::open(['url' => route('account.store'), 'class' => 'account-form', 'id' => 'account', 'files'=>'true']) !!}
                <div class="col-md-8">
                    <div class="form-group {{ $errors->has('short_bio') ? ' has-error' : '' }}">
                        {{ Form::label('short_bio', 'Short Bio') }}
                        {{ Form::textarea('short_bio', (count($user->userProfile)?$user->userProfile->short_bio:null), ['class' => 'form-control rounded', 'size' => '30x5']) }}
                    </div>
                    <h3>Experience</h3>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('expertise', 'expertise of experience') }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('length', 'length of experience') }}
                        </div>
                    </div>
                    <div class="experience-wrap margin-bottom-20">
                        @if (Form::old('category_id'))
                            @foreach(old('category_id') as $key => $val)
                                <div class="row margin-bottom-20">
                                    <div class="col-md-5 {!! $errors->first('category_id.'.$key, 'has-error') !!}">
                                        {{ Form::select('category_id['.$key.']', [null=>''] + $categories, old('category_id.'.$key), array('class'=>'form-control input-lg rounded')) }}
                                        <span class="help-block">
                                            <strong>{!! $errors->first('category_id.'.$key, ':message') !!}</strong>
                                        </span>
                                    </div>
                                    <div class="col-md-5 {!! $errors->first('length_id.'.$key, 'has-error') !!}">
                                        {{ Form::select('length_id['.$key.']', [null=>''] + $lengths, old('length_id.'.$key), array('class'=>'form-control input-lg rounded')) }}
                                        <span class="help-block">
                                            <strong>{!! $errors->first('length_id.'.$key, ':message') !!}</strong>
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="#" id="delete_exp_btn" class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        @foreach ($userExperiences as $userExp)
                            <div class="row margin-bottom-20">
                                <div class="col-md-5">
                                    {!! Form::select('category_id[]', [null=>''] + $categories, $userExp->category_id, ['class' => 'form-control input-lg rounded']) !!}
                                </div>
                                <div class="col-md-5">
                                    {!! Form::select('length_id[]', [null=>''] + $lengths, $userExp->length_id, ['class' => 'form-control input-lg rounded']) !!}
                                </div>
                                <div class="col-md-2">
                                    <a href="#" id="delete_exp_btn" class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></a>
                                </div>
                                {!! Form::text('experience_id[]', $userExp->id, ['class' => 'hide', 'id' => 'experience_ids'])  !!}
                            </div>
                        @endforeach
                            @if ($userExperiences->count() == 0)
                            <div class="row margin-bottom-20">
                                <div class="col-md-5">
                                    {{ Form::select('category_id[]', [null=>''] + $categories, null, ['class' => 'form-control input-lg rounded']) }}
                                </div>
                                <div class="col-md-5">
                                    {{ Form::select('length_id[]', $lengths, null, ['class' => 'form-control input-lg rounded']) }}
                                </div>

                            </div>
                            @endif
                        @endif
                        <a href="#" class="color-main" id="add_exp_btn">add more experience</a>
                    </div>
                    <div class="margin-bottom-20">
                        <h3>Jobs / skills interested in </h3>
                        <p>(you will be notified of these jobs when they are posted in your area.</p>
                        <div class="skill-wrap">
                            @if (Form::old('area_suburb_id'))
                                @foreach(old('area_suburb_id') as $key => $val)
                                    <div class="row margin-bottom-20">
                                        <div class="col-md-5 {!! $errors->first('area_suburb_id.'.$key, 'has-error') !!}">
                                            {{ Form::select('area_suburb_id['.$key.']', [null=>''] + $locations, old('area_suburb_id.'.$key), array('class'=>'form-control input-lg rounded')) }}
                                            <span class="help-block">
                                                <strong>{!! $errors->first('area_suburb_id.'.$key, ':message') !!}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-5 {!! $errors->first('sec_category_id.'.$key, 'has-error') !!}">
                                            {{ Form::select('sec_category_id['.$key.']', [null=>''] + $categories, old('sec_category_id.'.$key), array('class'=>'form-control input-lg rounded')) }}
                                            <span class="help-block">
                                                <strong>{!! $errors->first('sec_category_id.'.$key, ':message') !!}</strong>
                                            </span>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="#" id="delete_interested_btn" class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            @foreach ($userJobInterestedLocations as $inLocation)
                                <div class="row margin-bottom-20">
                                    <div class="col-md-5">
                                        {{ Form::select('area_suburb_id[]', [null=>''] + $locations, $inLocation->area_suburb_id, ['class' => 'form-control input-lg rounded']) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::select('sec_category_id[]', [null=>''] + $categories, $inLocation->category_id, ['class' => 'form-control input-lg rounded']) }}
                                    </div>
                                    <div class="col-md-2">
                                        <a href="#" id="delete_interested_btn" class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></a>
                                    </div>

                                    {{ Form::text('user_interested_location_id[]', $inLocation->id, ['class' => 'hide', 'id' => 'interested_ids']) }}
                                </div>
                            @endforeach
                                @if ($userJobInterestedLocations->count() == 0)
                                <div class="row margin-bottom-20">
                                    <div class="col-md-5">
                                        {{ Form::select('area_suburb_id[]', [null=>''] + $locations, null, ['class' => 'form-control input-lg rounded']) }}
                                    </div>
                                    <div class="col-md-5">
                                        {{ Form::select('sec_category_id[]', [null=>''] + $categories, null, ['class' => 'form-control input-lg rounded']) }}
                                    </div>
                                </div>
                                @endif
                            @endif
                            <a href="#" class="color-main" id="add_interested_btn">add more interested</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary rounded btn-lg">Submit</button>
                </div>
                <div class="col-md-3 col-md-offset-1 text-center">
                    <div class="img-wrap margin-bottom-20">
                        @if (count($user->userProfile) && $user->userProfile->image_name != '')
                            <img src="{{ Config::get('frontend.user_avatar_path').Config::get('frontend.full_size').$user->userProfile->image_name }}" class="img-responsive" style="display: inline-block"/>
                        @else
                            <img src="img/no-profile.png" class="img-responsive" style="display: inline-block"/>
                        @endif
                    </div>
                    <div class="fileUpload color-main">
                        <span>Add a profile image</span>
                        <input type="file" class="upload" id="user_avatar" name="file"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/js/pages/account.js?'.time()) !!}
    <script>
        Account.init();
        $(function() {
            $('input#user_avatar').on('change', function() {
                return Common.read_image(this, 'img-wrap');
            });
        })
    </script>
@endsection