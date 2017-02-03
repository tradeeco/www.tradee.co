@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container m-t-94 home content">
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
                                {!! Form::open(['url' => route('jobs.store'), 'class' => 'create-job', 'data-parsley-validate', 'id' => 'create_job']) !!}
                                <div class="form-group">
                                    {{ Form::label('title', 'Job Title') }}
                                    {{ Form::text('title', null, array('class' => 'input-lg form-control rounded', 'id' => 'title', 'required' => 'true')) }}
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                    <div class="col-md-4">
                                        {{ Form::label('category', 'Category') }}
                                        <select class="form-control rounded input-lg">
                                            <option>Category</option>
                                            <option>Loerm Posum</option>
                                            <option>Loerm Posum</option>
                                            <option>Loerm Posum</option>
                                            <option>Loerm Posum</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Area / Suburb</label>
                                        <select class="form-control rounded input-lg">
                                            <option>Area / Suburb</option>
                                            <option>Loerm Posum</option>
                                            <option>Loerm Posum</option>
                                            <option>Loerm Posum</option>
                                            <option>Loerm Posum</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label>Short Description:</label>
                                        <textarea type="text" class="form-control input-lg rounded" name="" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Add Photos</label>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="button" class="btn btn-primary rounded btn-lg">Post</button>
                                    </div>

                                </form>
                            </div>

                            <div id="passwordTab" class="panel-body tab-pane fade">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <select class="form-control rounded input-lg">
                                                <option>Category</option>
                                                <option>Loerm Posum</option>
                                                <option>Loerm Posum</option>
                                                <option>Loerm Posum</option>
                                                <option>Loerm Posum</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control rounded input-lg">
                                                <option>Area / Suburb</option>
                                                <option>Loerm Posum</option>
                                                <option>Loerm Posum</option>
                                                <option>Loerm Posum</option>
                                                <option>Loerm Posum</option>
                                            </select>
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
