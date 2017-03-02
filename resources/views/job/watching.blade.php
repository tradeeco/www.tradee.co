@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/css/pages/page_job.css?'.time()) !!}
    {!! Html::style('frontend/css/pages/page_search_inner_tables.css?'.time()) !!}

@stop
@section('body')
    <div class="container content">
        @include('partial/alert_message')
        <div class="tab-v2">
            <ul class="nav nav-tabs">
                <li class="{{ getActionName(Route::getCurrentRoute()->getActionName()) == 'watching' ? 'active' : '' }}">
                    <a href="{{ URL::route('jobs.watching') }}" aria-expanded="false">Watching</a></li>
                <li class="{{ getActionName(Route::getCurrentRoute()->getActionName()) == 'interest' ? 'active' : '' }}">
                    <a href="{{ URL::route('jobs.interest') }}" >Interested</a></li>
                <li class="{{ getActionName(Route::getCurrentRoute()->getActionName()) == 'shortlist' ? 'active' : '' }}">
                    <a href="{{ URL::route('jobs.shortlist') }}">Shortlisted</a></li>
                <li class="" ><a href="javascript:void(0)">Previous jobs</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in {{ getActionName(Route::getCurrentRoute()->getActionName()) == 'watching' ? 'active' : '' }}" id="watching">
                    <div class="table-search-v2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="hidden-sm">Job content</th>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($taggedJobs as $taggedJob)
                                    <?php $job = $taggedJob->job ?>
                                    <tr>
                                        <td>
                                            <a href="{{ URL::route('jobs.show', $job->slug) }}">
                                                <img class="full-width" style="width: 200px; height: 150px;" src="{{ jobPhotoSmallSrc($job->jobPhotos->first()) }}" alt="">
                                            </a>
                                        </td>
                                        <td class="job-title" style="width: 30%;">
                                            <h3><a href="{{ URL::route('jobs.show', $job->slug) }}" data-id="{{$taggedJob->id}}">{{ $job->title }}</a></h3>
                                            <p>{{ $job->category->name }}</p>
                                            <p>{{ $job->areaSuburb->name }}</p>
                                            <p>{{ str_limit($job->description, 50) }}</p>
                                        </td>
                                        <td>
                                            <h3 class="color-main">Views: XXX</h3>
                                            <h3 class="color-main">Date Posted: {{ date('F d, Y', strtotime($job->created_at)) }}</h3>
                                            {{--Carbon\Carbon::parse($job->created_at)->format('d-m-Y i')--}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary rounded text-uppercase white-color" id="move_interest">show interest</a>
                                        </td>
                                        <td>
                                            <a href="#" class="color-main" id="delete_tagged">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in {{ getActionName(Route::getCurrentRoute()->getActionName()) == 'interest' ? 'active' : '' }}" id="profile-1">
                    <div class="table-search-v2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="hidden-sm">Job content</th>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($taggedJobs as $taggedJob)
                                    <?php $job = $taggedJob->job ?>
                                    <tr>
                                        <td>
                                            <a href="{{ URL::route('jobs.show', $job->slug) }}">
                                                <img class="full-width" style="width: 200px; height: 150px;" src="{{ jobPhotoSmallSrc($job->jobPhotos->first()) }}" alt="">
                                            </a>
                                        </td>
                                        <td class="job-title" style="width: 30%;">
                                            <h3><a href="{{ URL::route('jobs.show', $job->slug) }}" data-id="{{$taggedJob->id}}">{{ $job->title }}</a></h3>
                                            <p>{{ $job->category->name }}</p>
                                            <p>{{ $job->areaSuburb->name }}</p>
                                            <p>{{ str_limit($job->description, 50) }}</p>
                                        </td>
                                        <td>
                                            <h3 class="color-main">Views: XXX</h3>
                                            <h3 class="color-main">Date Posted: {{ date('F d, Y', strtotime($job->created_at)) }}</h3>
                                            {{--Carbon\Carbon::parse($job->created_at)->format('d-m-Y i')--}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary rounded" id="delete_tagged">Remove Interest</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in {{ getActionName(Route::getCurrentRoute()->getActionName()) == 'shortlist' ? 'active' : '' }}" id="messages-1">
                    <div class="table-search-v2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>User Info</th>
                                    <th class="hidden-sm">Job content</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($taggedJobs as $taggedJob)
                                    <?php $job = $taggedJob->job ?>
                                    <tr>
                                        <td>
                                            <a href="{{ URL::route('jobs.show', $job->slug) }}">
                                                <img class="full-width" style="width: 200px; height: 150px;" src="{{ jobPhotoSmallSrc($job->jobPhotos->first()) }}" alt="">
                                            </a>
                                        </td>
                                        <td class="job-title" style="width: 30%;">
                                            <h3><a href="{{ URL::route('jobs.show', $job->slug) }}" data-id="{{$taggedJob->id}}">{{ $job->title }}</a></h3>
                                            <p>{{ $job->category->name }}</p>
                                            <p>{{ $job->areaSuburb->name }}</p>
                                            <p>{{ str_limit($job->description, 50) }}</p>
                                        </td>
                                        <td>
                                            <h3 class="color-main">Views: XXX</h3>
                                            <h3 class="color-main">Date Posted: {{ date('F d, Y', strtotime($job->created_at)) }}</h3>
                                            {{--Carbon\Carbon::parse($job->created_at)->format('d-m-Y i')--}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary rounded text-uppercase" id="delete_tagged">Remove Yourself</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

    {!! Html::script('frontend/js/pages/job.js?'.time()) !!}
    <script>
        Job.init();
    </script>
@endsection