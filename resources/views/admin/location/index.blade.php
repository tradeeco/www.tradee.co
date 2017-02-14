@extends('layout.admin')

@section('custom-styles')
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Location</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{URL::route('admin.home')}}">Home</a>
                </li>
                <li class="active">
                    <a href="#">Location</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>ADD NEW Location</h5>
            </div>
            <div class="ibox-content">

                <?php if (isset($alert)) { ?>
                <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <p>
                        <?php echo $alert['msg'];?>
                    </p>
                </div>
                <?php } ?>

                {{ Form::open(array('url' => 'admin/locations', 'class' => 'new-location-form')) }}
                    <div class="row m-b categories">
                        @if(Form::old('name'))
                            @foreach(old('name') as $key => $val)
                                <div class="col-sm-4 m-b input-wrap {!! $errors->first('name.'.$key, 'has-error') !!}">
                                    {!! Form::text('name['.$key.']', old('name.'.$key), array('class'=>'form-control input-lg', 'maxlength' => 25)) !!}
                                    <span class="help-block">
                                        <strong>{!! $errors->first('name.'.$key, '<p>:message</p>') !!}</strong>
                                    </span>
                                    <a href="#" id="delete_cat_btn" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                </div>
                            @endforeach
                        @else
                        <div class="col-sm-4 m-b input-wrap">
                            <input type="text" class="form-control rounded input-lg" name="name[]" autofocus maxlength="25">
                        </div>
                        @endif
                        <div class="col-sm-2"><button class="btn btn-lg btn-primary" type="submit">ADD</button></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a class="color-main decoration" href="#" id="add_cat_btn">add another location</a>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h3>CURRENT LOCATIONS</h3>
            </div>
            <div class="ibox-content">
                <table class="table">
                  <thead>
                    <tr>
                        <th>Name</th>
                        <th>Added Date</th>
                        <th>Action+</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($locations as $location)
                    <tr>
                        <td>{{$location->name}}</td>
                        <td>{{$location->created_at}}</td>
                        <td>
                            <a href="{!! URL::route('admin.locations.destroy', $location->id)  !!}" class="btn btn-xs btn-danger" id="delete_btn">
                                <i class="fa fa-trash"> Delete</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $locations->links() }}
            </div>
        </div>
    </div>
@stop

@section('custom-scripts')
    <script>
        TradeAdmin.init();
    </script>
@endsection

