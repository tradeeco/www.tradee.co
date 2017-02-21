@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h1 class="margin-bottom-35">MY ACCOUNT</h1>
        <div class="row margin-bottom-20 text-center">
            <div class="col-md-12">
                <h3 class="label-color">Your payment details</h3>
            </div>
        </div>
        <div class="row margin-bottom-40">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Card type:</label>
                        <div class="col-lg-4">
                            <select class="form-control"><option></option><option>Credit Card</option><option>Visa Card</option></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Card number:</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="XXXXXXXX">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Card holder name:</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="XXXX">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Expiry:</label>
                        <div class="col-lg-2">
                            <select class="form-control">
                                <option>month</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <select class="form-control">
                                <option>year</option>
                                <option>2015</option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <label for="inputEmail1" class="col-lg-2 control-label">Card security code:</label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" placeholder="XXXX">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Save these details for next time i credit my account

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Amount to credit:</label>
                        <div class="col-lg-4">
                            <h4 class="label-color">$XX.XX</h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <a href="" class="btn-u btn-u-default margin-right-15">Cancel</a>
                            <a href="{{URL::route('account.index')}}" class="btn-u btn-u-default">Pay Now</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    {!! Html::script('frontend/js/pages/account.js?'.time()) !!}
    <script>
    </script>
@endsection