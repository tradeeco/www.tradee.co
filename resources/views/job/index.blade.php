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
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            {{ Form::select('area_suburb_id', $locations, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="button" class="btn-u btn-block btn-u-dark"> Search Job</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-search-v2 panel panel-dark">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-globe"></i> Table Search Results</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>User Image</th>
                        <th class="hidden-sm">About</th>
                        <th>Status</th>
                        <th>Contacts</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($jobs as $job)
                        <tr>
                            <td>
                                <img class="rounded-x" src="assets/img/testimonials/img1.jpg" alt="">
                            </td>
                            <td class="td-width">
                                <h3><a href="#">Sed nec elit arcu</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id commodo lacus. Fusce non malesuada ante. Donec vel arcu.</p>
                                <small class="hex">Joined February 28, 2014</small>
                            </td>
                            <td>
                                <span class="label label-success">Success</span>
                            </td>
                            <td>
                                <ul class="list-inline s-icons">
                                    <li>
                                        <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Facebook" href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Twitter" href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Dropbox" href="#">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="Linkedin" href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                                <span><a href="#">info@example.com</a></span>
                                <span><a href="#">www.htmlstream.com</a></span>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pull-right">
            {{ $jobs->links() }}
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/js/pages/home.js?'.time()) !!}
    <script>
        Home.init();
    </script>
@endsection