<html>
<head>
</head>
<body style="font-family:calibri;font-size:10;">

@if(isset($template))
{{ $template }}
@else
Hi, {{$email}}!
 
<p>We'd like to inform you that you have confirmed your registration in Mistminds application. You can sign in to our application by using your credentials.</p>
@endif

</body>
</html>