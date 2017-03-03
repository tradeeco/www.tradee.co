<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('emails/bootstrap_css');
</head>
<body>
<h1>Welcome to <a href="{{ config('app.url') }}">{{ config('app.name') }}</a></h1>
<p>
    Thank you for signing up with TRADEE! Your new account is now fully setup and you are ready to start posting or searching for jobs!
</p>
<P>
    Help us bring more communities together at <a href="{{ config('app.url') }}">www.tradee.co!</a>
</P>
<P>Kind regards</P>
<hr/>
<b>TRADEE Team</b>
</body>
</html>
