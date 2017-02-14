@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h2 class="margin-bottom-35">YOUR TRADEE PROFILE</h2>
        <div class="row">
            {!! Form::open(['url' => route('account.store'), 'class' => 'account-form', 'id' => 'account']) !!}
                <div class="col-md-8">
                    <div class="form-group">
                        {{ Form::label('short_bio', 'Short Bio') }}
                        {{ Form::textarea('short_bio', null, ['class' => 'form-control rounded', 'size' => '30x5']) }}
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
                        @foreach ($userExperiences as $userExp)
                        <div class="row margin-bottom-20">
                            <div class="col-md-6">
                                {{ Form::select('category_id[]', [null=>''] + $categories, null, ['class' => 'form-control input-lg rounded']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::select('length_id[]', $lengths, null, ['class' => 'form-control input-lg rounded']) }}
                            </div>
                            {{ Form::text('experience_id[]', null, ['class' => 'hide']) }}
                        </div>
                        @endforeach
                        <div class="row margin-bottom-20">
                            <div class="col-md-6">
                                {{ Form::select('category_id[]', [null=>''] + $categories, null, ['class' => 'form-control input-lg rounded']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::select('length_id[]', $lengths, null, ['class' => 'form-control input-lg rounded']) }}
                            </div>
                        </div>
                        <a href="#" class="color-main" id="add_exp_btn">add more experience</a>
                    </div>
                    <div class="skill-wrap">
                        <h3>Jobs / skills interested in </h3>
                        <p>(you will be notified of these jobs when they are posted in your area.</p>
                    </div>
                    <button type="submit" class="btn btn-primary rounded btn-lg">Submit</button>
                </div>
                <div class="col-md-3 col-md-offset-1 text-center">
                    <div class="img-wrap margin-bottom-20">
                        <img src="img/no-profile.png" class="img-responsive" style="display: inline-block"/>
                    </div>
                    <div class="fileUpload color-main">
                        <span>Add a profile image</span>
                        <input type="file" class="upload" />
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
    </script>
@endsection