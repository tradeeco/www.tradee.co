@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h2 class="margin-bottom-35">MY ACCOUNT</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>TRADEE</h3>
                <ul class="nav list-unstyled" role="menu">
                    <li><a href="#">watching</a></li>
                    <li><a href="#">instered</a></li>
                    <li><a href="#">shortlisted</a></li>
                    <li><a href="#">previous jobs</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h3>TRADER</h3>
                <ul class="nav list-unstyled margin-bottom-20" role="menu">
                    <li><a href="#">my jobs</a></li>
                    <li><a href="#">previous jobs</a></li>
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