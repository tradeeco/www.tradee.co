@extends('layout.frontend')

@section('body')
<div class="container  m-t-94 content">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center margin-bottom-25">Sign In </h1>
            @include('partial/login_form')
        </div>
    </div>
</div>
@stop
