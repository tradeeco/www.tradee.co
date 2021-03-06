@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/css/pages/page_job.css?'.time()) !!}
    {!! Html::style('frontend/css/pages/page_search_inner_tables.css?'.time()) !!}
    {!! Html::style('backend/css/plugins/chosen/bootstrap-chosen.css?'.time()) !!}
    <style>
        .frontend .chosen-container-single .chosen-single {
            border-radius: 0;
        }
        ::selection {
            background: #ffb7b7; /* WebKit/Blink Browsers */
        }
    </style>
@stop
@section('body')
    <div class="job-img margin-bottom-30">
        <div class="job-banner">
            <h2>SEARCH FOR JOBS</h2>
        </div>
        <div class="job-img-inputs">
            {!! Form::open(['url' => route('jobs.index'), 'id' => 'search_job', 'method' => 'GET']) !!}
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            {{ Form::select('category', [''=>'Category'] + $categories, isset($getParams['category']) ? $getParams['category'] : null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            {{ Form::select('location', [''=>'Area / Suburb'] + $locations, isset($getParams['location']) ? $getParams['location'] : null, ['class' => 'form-control chosen-select']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-block btn-primary"> Search Job</button>
                    </div>
                </div>
            </div>
            {{ Form::text('sort', isset($getParams['sort']) ? $getParams['sort'] : null, ['class' => 'hide']) }}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="container">
        <div class="table-search-v2 panel panel-main">
            <div class="panel-heading bg-color-main">
                <div class="row">
                    <div class="col-sm-2">
                        <h3 class="panel-title"><i class="fa fa-globe"></i> Sort</h3>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::open(['url' => route('jobs.index'), 'id' => 'sort_job', 'method' => 'GET']) !!}
                            {{ Form::select('sort', ['created_DESC'=>'Latest post', 'created_ASC' => 'Old post'], isset($getParams['sort']) ? $getParams['sort'] : null, ['class' => 'form-control rounded']) }}
                            {{ Form::text('category', isset($getParams['category']) ? $getParams['category'] : null, ['class' => 'hide']) }}
                            {{ Form::text('location', isset($getParams['location']) ? $getParams['location'] : null, ['class' => 'hide']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="hidden-sm">Job content</th>
                        <th></th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($jobs as $job)
                        <tr>
                            <td>
                                {{--<a href="{{ URL::route('users.profile', $job->user->slug) }}">--}}
                                {{--<img class="rounded-x" src="{{ userImage($job->user) }}" alt="">--}}
                                {{--<span class="text-center">{{ $job->user->first_name }}</span>--}}
                                {{--</a>--}}
                                <a href="{{ URL::route('jobs.show', $job->slug) }}">
                                    <img class="full-width" style="width: 200px; height: 150px;" src="{{ jobPhotoSmallSrc($job->jobPhotos->first()) }}" alt="">
                                </a>
                            </td>
                            <td class="td-width">
                                <h3><a href="{{ URL::route('jobs.show', $job->slug) }}">{{ $job->title }}</a></h3>
                                <p>{{ $job->category->name }}</p>
                                <p>{{ $job->areaSuburb->name }}</p>
                                <p>{{ str_limit($job->description, 50) }}</p>
                            </td>
                            <td>
                                <h3 class="color-main">Views: XXX</h3>
                                <h3 class="color-main">Date Posted: {{ date('F d, Y', strtotime($job->created_at)) }}</h3>
                                {{--Carbon\Carbon::parse($job->created_at)->format('d-m-Y i')--}}
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pull-right">
            {{ $jobs->appends($getParams)->links() }}
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('backend/js/plugins/chosen/chosen.jquery.js?'.time())  !!}
    <script>
        $(function () {
            $('.chosen-select').chosen({width: "100%"});
        });
        $(document).on('change', 'form#sort_job select', function (e) {
            var category = $('select[name=category]').val();
            var location = $('select[name=location]').val();
            var formObj = $(this).parent();
            $(this).parent().submit();
        });
    </script>
@endsection