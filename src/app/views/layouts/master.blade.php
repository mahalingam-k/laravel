<!DOCTYPE html>
<html lang='en'>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>@yield('title')</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    {{ HTML::script('packages/datepicker/js/bootstrap-datepicker.js'); }}
    {{ HTML::script('packages/validate/js/bootstrap-validator.min.js'); }}
    {{ HTML::script('js/bootbox.min.js'); }}
    {{ HTML::script('js/admin.js'); }}
	{{ HTML::script('js/jquery.tocible.js') }}
	
    <link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
    {{ HTML::style('css/admin.css'); }}
    {{ HTML::style('packages/datepicker/css/datepicker.css'); }}
    {{ HTML::style('packages/validate/css/bootstrap-validator.css'); }}
	{{ HTML::style('css/tocible.css'); }}
	<style>
#pagin li { 
display: inline; 
padding: 1px;
}
#section_wrapper {
background: #FAFAFA;
padding: 20px 0;
box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.2);
margin-top: 250px;
font-size: 16px;
line-height: 26px;
position: relative;
overflow: auto;
}
#section_wrapper article {
width: 900px;
overflow: hidden;
margin-left: 100px;
float: left;
}
#section_wrapper h2 {
font-size: 30px;
font-weight: normal;
margin-top: 12px;
margin: 28px 0 10px 0;
}
#section_wrapper h3 {
font-size: 22px;
margin: 15px 0 10px 0;
font-weight: normal;
}
#tocible {
background: #CCC;
float: left;
margin-left: 20px;
}

.auto-style122 {
	font-family: Calibri;
	font-size: medium;
}
.auto-style399 {
	text-align: center;
}
.auto-style400 {
	text-align: right;
	font-family: Calibri;
	color: #FFFFFF;
	font-size: medium;
}
</style>
</head>
<body>
<div >
<table style="width: 100%">
			
			@yield('content')
			
		</table>
</div>
</body>
</html>