<html>
<head>
</head>
<body style="font-family:calibri;font-size:10;">

@if(isset($template))
{{ $template }}
@else
Hi, {{$email}}!
 
<p>Sorry to inform you that your Mistminds account is banned.</p>
@endif

</body>
</html>