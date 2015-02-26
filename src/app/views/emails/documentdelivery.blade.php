<html>
<head>
</head>
<body style="font-family:calibri;font-size:10;">
@if(isset($template))
{{ $template }}
@else
Hi, {{$email}}!
 
<p>Please find attached Delivery of searched document in RTF format.</p>
@endif

</body>
</html>