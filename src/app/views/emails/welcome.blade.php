<html>
<head>
</head>
<body style="font-family:calibri;font-size:10;">
{{ $template }}

<div>
            Please follow the link below to verify your email address
            {{ URL::to('register/verify/' . $confirmation_code) }}<br/>

 </div>
 </body>
 </html>