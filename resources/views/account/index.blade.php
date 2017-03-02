@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h2 class="margin-bottom-35">MY ACCOUNT</h2>
        <div class="row margin-bottom-20">
            <div class="col-md-6">
                <h3>TRADEE</h3>
                <ul class="nav list-unstyled" role="menu">
                    <li><a href="{{ URL::route('jobs.watching') }}">Watching</a></li>
                    <li><a href="{{ URL::route('jobs.interest') }}">Interested</a></li>
                    <li><a href="{{ URL::route('jobs.shortlist') }}">Shortlisted</a></li>
                    <li><a href="#">Previous Jobs</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>TRADER</h3>
                <ul class="nav list-unstyled margin-bottom-20" role="menu">
                    <li><a href="{{ URL::route('jobs.mine') }}">My Jobs</a></li>
                    <li><a href="#">Previous Jobs</a></li>
                </ul>
                <a href="{{ URL::route('account.edit_contact') }}" class="btn-u btn-u-default">edit my account</a>
            </div>
        </div>
        <div class="row margin-bottom-40">
            <div class="col-md-12">
                <h3 class="margin-bottom-25">Account Balance</h3>
            </div>
            <div class="col-md-5">
                <h4 class="label-color"> balance: <b>$0.00</b></h4>
                <small>request account statement</small>
            </div>
            <div class="col-md-7">
                <a href="{{ URL::route('account.add_funds1') }}" class="btn-u btn-u-default btn-u-lg">credit my account</a>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/js/pages/account.js?'.time()) !!}
    <script>
    </script>
@endsection