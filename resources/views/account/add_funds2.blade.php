@extends('layout.frontend')
@section('custom-styles')

@stop
@section('body')
    <div class="container content">
        <h1 class="margin-bottom-35">MY ACCOUNT</h1>
        <div class="row margin-bottom-20 text-center">
            <div class="col-md-12">
                <h3 class="label-color">Add credit to your TRADEE wallet</h3>
                <h4>Current balance: $XX.XX</h4>
            </div>
        </div>
        <div class="row margin-bottom-40">
            <div class="col-md-12">
                <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Amount:</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="inputEmail1" placeholder="$XX.XX">
                        </div>
                    </div>
                    <div class="form-group margin-bottom-40">
                        <label for="inputPassword1" class="col-lg-2 control-label">Pay by:</label>
                        <div class="col-lg-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    Existing credit card <br/>
                                    <small>xxxxxxxxxxxxxxxxxxx</small>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    Use a different credit card
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    Internet or phone banking
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    Pay by other means
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <a href="" class="btn-u btn-u-default margin-right-15">Cancel</a>
                            <a href="{{URL::route('account.add_funds3')}}" class="btn-u btn-u-default">NEXT</a>
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