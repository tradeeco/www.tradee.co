@extends('layout.frontend')
@section('custom-styles')
    {!! Html::style('frontend/plugins/sky-forms-pro/skyforms/css/sky-forms.css?'.time()) !!}
    {!! Html::style('frontend/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css?'.time()) !!}
@stop
@section('body')
    <section class="bg-color-main">
        <div>
            {{--<h2 class="margin-bottom-35">MY ACCOUNT</h2>--}}
            <div class="row">
                <div class="col-md-6 text-center margin-top-20">
                    <h2 class="margin-bottom-20">Support Enquiries</h2>
                    <h4 class="margin-bottom-20" ><i class="fa fa-phone margin-right-20 fa-lg"></i> + 64 9XX XXX XX</h4>
                    <h4 class="margin-bottom-20" ><i class="fa fa-envelope-o margin-right-20 fa-lg"></i>support@tradee.co</h4>
                    <h2 class="margin-bottom-20">General Enquiries</h2>
                    <h4 class="margin-bottom-20" ><i class="fa fa-phone margin-right-20 fa-lg"></i> + 64 9XX XXX XX</h4>
                    <h4 class="margin-bottom-20" ><i class="fa fa-envelope-o margin-right-20 fa-lg"></i>info@tradee.co</h4>
                    <h2 class="margin-bottom-20">Other Enquiries</h2>
                    <h4 class="margin-bottom-30" ><i class="fa fa-envelope-o margin-right-20 fa-lg"></i>admin@tradee.co</h4>

                    <h3 class="margin-bottom-20">Find us on:</h3>
                    <div>
                    <button class="btn btn-default circle btn-lg margin-right-20 margin-left-10 color-main" style="width: 55px; height: 55px"><i class="fa fa-facebook fa-lg"></i></button>
                    <button class="btn btn-default btn-lg circle margin-right-10 margin-left-10 color-main" style="width: 55px; height: 55px"><i class="fa fa-instagram fa-lg"></i></button>
                    <button class="btn btn-default btn-lg circle margin-left-20 color-main" style="width: 55px; height: 55px"><i class="fa fa-twitter fa-lg"></i></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="content-sm container text-center">
            <h3>Cant wait? We will contact you!</h3>
            <h4 class="margin-bottom-40"><b>Send us a message below.</b></h4>
            {!! Form::open(['url' => route('pages.post_contact'), 'class' => 'sky-form contact-style', 'id' => 'contact_form',]) !!}
                <fieldset class="no-padding">
                    {{ Form::label('name', 'Name') }}
                    <div class="row sky-space-20">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="{{ $errors->has('name') ? ' state-error' : '' }}">
                                {{ Form::text('name', old('name'), array('class' => 'form-control', 'id' => 'name')) }}
                            </div>
                            @if ($errors->has('name'))
                                <em class="invalid">
                                    {{ $errors->first('name') }}
                                </em>
                            @endif
                        </div>
                    </div>

                    {{ Form::label('email', 'Email') }}
                    <div class="row sky-space-20">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="{{ $errors->has('email') ? ' state-error' : '' }}">
                                {{ Form::text('email', old('email'), array('class' => 'form-control', 'id' => 'email')) }}
                            </div>
                            @if ($errors->has('email'))
                                <em class="invalid">
                                    {{ $errors->first('email') }}
                                </em>
                            @endif
                        </div>
                    </div>

                    {{ Form::label('subject', 'Subject') }}
                    <div class="row sky-space-20">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="{{ $errors->has('subject') ? ' state-error' : '' }}">
                                {{ Form::text('subject', old('subject'), array('class' => 'form-control', 'id' => 'subject')) }}
                            </div>
                            @if ($errors->has('subject'))
                                <em class="invalid">
                                    {{ $errors->first('subject') }}
                                </em>
                            @endif
                        </div>
                    </div>

                    {{ Form::label('message', 'Message') }}
                    <div class="row sky-space-20">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="{{ $errors->has('subject') ? ' state-error' : '' }}">
                                {{ Form::textarea('message', old('message'), array('class' => 'form-control', 'id' => 'message')) }}
                            </div>
                            @if ($errors->has('message'))
                                <em class="invalid">
                                    {{ $errors->first('message') }}
                                </em>
                            @endif
                        </div>
                    </div>

                    <p><button type="submit" class="btn btn-primary btn-lg rounded">Send Message</button></p>
                </fieldset>

                <div class="message">
                    <i class="rounded-x fa fa-check"></i>
                    <p>Your message was successfully sent!</p>
                </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection

@section('custom-scripts')
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCDSb3wORiw36c9kGhpSVqjkTYtJpVp4l4&amp;callback=initMap" async defer></script>
    {!! Html::script('frontend/js/plugins/google-map.js?'.time()) !!}
    <script>
        function initMap() {
            GoogleMap.initGoogleMap();
        }
    </script>
@endsection