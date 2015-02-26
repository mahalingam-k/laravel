<html>
<head>
</head>
<body style="font-family:calibri;font-size:10;">

@if(isset($template))
{{ $template }}
@else
Hi, {{$email}}!
 
<p>Please find attached Delivery document in RTF format which contains search results.</p>
@endif

</body>
</html>