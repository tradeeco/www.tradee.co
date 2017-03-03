<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('emails/bootstrap_css')
</head>
<body>
<h4>One Visitor sent you message</h4>
<h5>
Subject: {{ $contact->subject }}
</h5>
<h5>Name: {{ $contact->name }}</h5>
<h5>Email: {{ $contact->email }}</h5>
<h5>Message</h5>
<P>
    {{ $contact->message }}
</P>
<P>Kind regards</P>
<b>TRADEE Team</b>
</body>
</html>
