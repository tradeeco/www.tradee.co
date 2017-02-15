@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/css/pages/page_job.css?'.time()) !!}
    {!! Html::style('frontend/css/pages/page_search_inner_tables.css?'.time()) !!}

@stop
@section('body')
    {{--<div class="container m-t-94 home content">--}}
        {{--<h1 class="text-center margin-bottom-35">SEARCH FOR JOBS</h1>--}}
        {{--<form class="form-inline" role="form">--}}
            {{--<div class="form-group">--}}
                {{--<label class="sr-only" for="exampleInputEmail2">Email address</label>--}}
                {{--<input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<label class="sr-only" for="exampleInputPassword2">Password</label>--}}
                {{--<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">--}}
            {{--</div>--}}
            {{--<button type="submit" class="btn-u btn-u-default">Sign in</button>--}}
        {{--</form>--}}
    {{--</div>--}}
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
                            {{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            {{ Form::select('location', $locations, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn-u btn-block btn-u-dark"> Search Job</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="container">
        <div class="table-search-v2 panel panel-dark">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-globe"></i> Job Search Results</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>User Info</th>
                        <th class="hidden-sm">Job content</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($jobs as $job)
                        <tr>
                            <td>
                                <img class="rounded-x" src="{{ userImage($job->user) }}" alt="">
                                <span class="text-center">{{ $job->user->username }}</span>
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
    <script>
    </script>
@endsection