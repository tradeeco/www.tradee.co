@extends('layout.frontend')

@section('custom-styles')
@stop
@section('body')
<div class="container m-t-94">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 margin-top-20 text-center">
            <h1 class="text-center margin-bottom-25">Sign up for FREE</h1>
            @include('partial/register_form')
        </div>
    </div>
</div>
@endsection
