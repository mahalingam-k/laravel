<!doctype html>
<html lang="en">
<head>
    
    <link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/redmond/jquery-ui.css">
	
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.js" type="text/javascript"></script>
	
    {{ HTML::style('packages/datepicker/css/datepicker.css'); }}
    {{ HTML::style('packages/validate/css/bootstrap-validator.css'); }}
    {{ HTML::style('css/style.css'); }}
	{{ HTML::style('css/tocible.css'); }}
	{{ HTML::style('css/ui.notify.css'); }}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    {{ HTML::script('packages/datepicker/js/bootstrap-datepicker.js'); }}
    {{ HTML::script('packages/validate/js/bootstrap-validator.min.js'); }}
    {{ HTML::script('js/script.js'); }}
	{{ HTML::script('js/jquery.tocible.js') }}
	{{ HTML::script('js/jquery.sticky.js') }}
	{{ HTML::script('js/jquery.notify.js') }}
	
<style>
#pagin{
font-family:calibri;
font-weight:large;	
	font-family: Calibri;
	font-size: large;
	font-size:18px;
	
}

#pagin li { 
display: inline-block; 
padding: 1px;
font-family: Calibri;
	font-size: large;
	font-size:18px;
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
<table style="width: 100%;z-index:999;">
			<tr>
				<td class="auto-style16" style="height: 54px; " colspan="5">
					@include('includes.menu')
				</td>
			</tr>
            <table style="width: 100%">
			<tr><td>@yield('content')</td> 
			</tr>
		</table>
    </table>
    
 
    <footer id="footer">
    <hr /> 
		<p class="auto-style12">&nbsp;</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0" height="1">
		  <tr>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
			<td width="16%" bgcolor="#FFFFFF" valign="top" height="1" class="auto-style12">&nbsp;
			</td>
			<td width="36%" bgcolor="#FFFFFF" align="right" height="1" class="auto-style12">&nbsp;
			</td>
			<td width="26%" bgcolor="#FFFFFF" height="1" valign="top" class="auto-style12">&nbsp;
			  </td>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
		  </tr>
		  <tr>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
			<td width="75%" bgcolor="#FFFFFF" valign="top" height="1" colspan="3" class="auto-style12">&nbsp;
			</td>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
		  </tr>
		  <tr>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
			<td width="75%" bgcolor="#FFFFFF" valign="top" height="1" colspan="3">
			  <p align="center" class="auto-style48"><font face="Calibri" color="#666666"><a href="/about">about</a> | <a href="/termsandconditions">terms and
			  conditions</a> | <a href="/help">help</a></font></td>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
		  </tr>
		  <tr>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
			<td width="16%" bgcolor="#FFFFFF" valign="top" height="1" class="auto-style5" colspan="3" style="width: 52%">
			Copyright  &#169;  1999-{{ date("Y") }} Mistminds. All rights reserved.</td>
			<td width="1%" bgcolor="#FFFFFF" height="1" class="auto-style12">&nbsp;</td>
		  </tr>
		</table>

		<p class="auto-style12">&nbsp;</p>
    </footer>
	 

</div>

</body>
</html>