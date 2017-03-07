@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/css/pages/profile.css?'.time()) !!}

@stop
@section('body')
    <div class="container content">
        <div class="row margin-bottom-30">
            <div class="col-md-12 margin-bottom-40">
                <div class="job-user profile">
                    <img src="{{ userImageSmall($user) }}" class="rounded-x pull-left margin-right-20" style="width: 150px; height: 150px;">
                    <div class="name-location">
                        <h3 class="margin-bottom-15">{{ $user->first_name }}</h3>
                        <h3 class="label-color margin-bottom-15">Rating - X X X X </h3>
                        <p>{{ $user->userProfile->short_bio }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-30">
            <div class="col-md-12">
                <h3 class="margin-bottom-15">Experience of {{ $user->first_name }}</h3>
                @foreach ($user->userExperiences as $experience)
                <span class="margin-right-20">{{ $experience->category->name }} - {{ $experience->length_id }} years</span>
                @endforeach
            </div>
        </div>
        <div class="row margin-bottom-30">
            <div class="col-md-12">
                <h3 class="margin-bottom-15">Interests of {{ $user->first_name }}</h3>
                @foreach ($user->userJobInterestedLocations as $inLocation)
                    <button class="margin-right-20 btn btn-primary btn-lg rounded">{{ $inLocation->category->name }}</button>
                @endforeach
            </div>
        </div>
        <div class="row margin-bottom-30">
            <div class="col-md-12">
                <h3 class="margin-bottom-15">Jobs done by {{ $user->first_name }}</h3>
                <img src="img/job-blank.png" style="width: 250px; height: 150px;" class="margin-right-20">
                <img src="img/job-blank.png" style="width: 250px; height: 150px;" class="margin-right-20">
                <img src="img/job-blank.png" style="width: 250px; height: 150px;" class="margin-right-20">
            </div>
        </div>
        <div class="row margin-bottom-30">
            <div class="col-md-12">
                <h3 class="margin-bottom-15">Reviews of {{ $user->first_name }}'s work</h3>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="image-block margin-bottom-20">
                            <img src="img/user-blank.png" style="width: 150px;">
                        </div>
                        <h3>John D</h3>
                        <ul class="list-inline star-vote">
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star-half-o fa-lg"></i></li>
                            <li><i class="color-main fa fa-star-o fa-lg"></i></li>
                        </ul>
                        <h4>"short review in words"</h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="image-block margin-bottom-20">
                            <img src="img/user-blank.png" style="width: 150px;">
                        </div>
                        <h3>John D</h3>
                        <ul class="list-inline star-vote">
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                        </ul>
                        <h4>"short review in words"</h4>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="image-block margin-bottom-20">
                            <img src="img/user-blank.png" style="width: 150px;">
                        </div>
                        <h3>John D</h3>
                        <ul class="list-inline star-vote">
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star fa-lg"></i></li>
                            <li><i class="color-main fa fa-star-o fa-lg"></i></li>
                        </ul>
                        <h4>"short review in words"</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
    </script>
@endsection