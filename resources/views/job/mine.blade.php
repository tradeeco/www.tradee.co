@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/css/pages/page_job.css?'.time()) !!}
    {!! Html::style('frontend/css/pages/page_search_inner_tables.css?'.time()) !!}

@stop
@section('body')
    <div class="container content">
        <h2>TRADER</h2>
        @include('partial/alert_message')
        <div class="tab-v2">
            <ul class="nav nav-tabs">
                <li class="{{ getActionName(Route::getCurrentRoute()->getActionName()) == 'mine' ? 'active' : '' }}">
                    <a href="{{ URL::route('jobs.watching') }}" aria-expanded="false">My jobs</a></li>
                <li class="" ><a href="javascript:void(0)">Previous jobs</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in {{ getActionName(Route::getCurrentRoute()->getActionName()) == 'mine' ? 'active' : '' }}" id="watching">
                    <div class="table-search-v2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="hidden-sm">Job Info</th>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td>
                                            <a href="{{ URL::route('jobs.show', $job->slug) }}">
                                                <img class="full-width" style="width: 200px; height: 150px;" src="{{ jobPhotoSmallSrc($job->jobPhotos->first()) }}" alt="">
                                            </a>
                                        </td>
                                        <td class="job-title" style="width: 30%;">
                                            <h3><a href="{{ URL::route('jobs.show', $job->slug) }}" data-id="{{$job->id}}">{{ $job->title }}</a></h3>
                                            <p>{{ $job->category->name }}</p>
                                            <p>{{ $job->areaSuburb->name }}</p>
                                            <p>{{ str_limit($job->description, 50) }}</p>
                                        </td>
                                        <td>
                                            <h3 class="color-main">Views: XXX</h3>
                                            <h3 class="color-main">Interested: {{ $job->taggedJobs->where('tag', 1)->count() }}</h3>
                                            <h3 class="color-main">Shortlisted: {{ $job->taggedJobs->where('tag', 2)->count() }}</h3>
                                            <h3 class="color-main">Date Posted: {{ date('F d, Y', strtotime($job->created_at)) }}</h3>
                                            {{--Carbon\Carbon::parse($job->created_at)->format('d-m-Y i')--}}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-primary rounded white-color" >close listing</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in {{ getActionName(Route::getCurrentRoute()->getActionName()) == 'previous' ? 'active' : '' }}" id="profile-1">
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