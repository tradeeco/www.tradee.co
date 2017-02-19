@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        {{--<h2 class="margin-bottom-35">MY ACCOUNT</h2>--}}
        <div class="row">
            <div class="col-md-6">
                <h3>TRADEE</h3>
                <ul class="nav list-unstyled" role="menu">
                    <li><a href="#">Watching</a></li>
                    <li><a href="#">Interested</a></li>
                    <li><a href="#">Shortlisted</a></li>
                    <li><a href="#">Previous Jobs</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>TRADER</h3>
                <ul class="nav list-unstyled margin-bottom-20" role="menu">
                    <li><a href="#">My Jobs</a></li>
                    <li><a href="#">Previous Jobs</a></li>
                </ul>
                <a href="{{ URL::route('account.edit_contact') }}" class="btn-u btn-u-default">edit my account</a>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/js/pages/account.js?'.time()) !!}
    <script>
    </script>
@endsection