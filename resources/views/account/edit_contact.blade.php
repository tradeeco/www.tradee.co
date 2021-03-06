@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h2 class="margin-bottom-35">CONTACT DETAILS</h2>
        {{ Form::open(array('url' => 'account/update_contact_details', 'class' => 'form-horizontal')) }}
        <div class="form-group">
            <div class="col-md-6 m-b {!! $errors->first('first_name', 'has-error') !!}">
                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', $user->first_name, ['class' => 'form-control input-lg rounded']) }}
                @if ($errors->has('first_name'))
                <span class="help-block">
                    <strong>{!! $errors->first('first_name', ':message') !!}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-6 m-b {!! $errors->first('last_name', 'has-error') !!}">
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', $user->last_name, ['class' => 'form-control input-lg rounded']) }}
                @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{!! $errors->first('last_name', ':message') !!}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 m-b {!! $errors->first('address', 'has-error') !!}">
                {{ Form::label('address', 'Address') }}
                {{ Form::text('address', $user->address, ['class' => 'form-control input-lg rounded']) }}
                @if ($errors->has('address'))
                    <span class="help-block">
                    <strong>{!! $errors->first('address', ':message') !!}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-6 m-b {!! $errors->first('area_suburb_id', 'has-error') !!}">
                {{ Form::label('area_suburb_id', 'Area / Suburb') }}
                {{ Form::select('area_suburb_id', [0 => ''] + $locations, $user->area_suburb_id, ['class' => 'form-control input-lg rounded']) }}
                @if ($errors->has('area_suburb_id'))
                    <span class="help-block">
                    <strong>{!! $errors->first('area_suburb_id', ':message') !!}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 m-b {!! $errors->first('phone', 'has-error') !!}">
                {{ Form::label('phone', 'Mobile #') }}
                {{ Form::text('phone', $user->phone, ['class' => 'form-control input-lg rounded']) }}
                @if ($errors->has('phone'))
                    <span class="help-block">
                    <strong>{!! $errors->first('phone', ':message') !!}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-6 m-b {!! $errors->first('post_code', 'has-error') !!}">
                {{ Form::label('post_code', 'Post Code') }}
                {{ Form::text('post_code', $user->post_code, ['class' => 'form-control input-lg rounded']) }}
                @if ($errors->has('post_code'))
                    <span class="help-block">
                    <strong>{!! $errors->first('post_code', ':message') !!}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group text-center"><button class="btn btn-lg btn-primary rounded" type="submit">Submit</button></div>
        {{ Form::close() }}
    </div>

@endsection

@section('custom-scripts')
    {{--{!! Html::script('frontend/js/pages/account.js?'.time()) !!}--}}
    <script>
    </script>
@endsection