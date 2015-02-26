<html>
<head>
</head>
<body style="font-family:calibri;font-size:10;">

@if(isset($template))
{{ $template }}
@else
Hi, {{$email}}!
 
<p>This is to inform you that you have closed(or deleted) your Mistminds account.</p>
@endif

</body>
</html>
