<html>
<head>
<meta content="en-ca" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel='stylesheet' href='//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/redmond/jquery-ui.css">
    {{ HTML::style('packages/datepicker/css/datepicker.css'); }}
    {{ HTML::style('packages/validate/css/bootstrap-validator.css'); }}
    {{ HTML::style('css/style.css'); }}
	{{ HTML::style('css/tocible.css'); }}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    {{ HTML::script('packages/datepicker/js/bootstrap-datepicker.js'); }}
    {{ HTML::script('packages/validate/js/bootstrap-validator.min.js'); }}
    {{ HTML::script('js/script.js'); }}
	{{ HTML::script('js/jquery.tocible.js') }}
	{{ HTML::script('js/jquery.sticky.js') }}
<title>REGISTER OR SIGN IN TO ENABLE TH</title>
<style type="text/css">
.auto-style1 {
	font-family: Calibri;
	text-align: center;
	background-color: #C0C0C0;
}
.auto-style15 {
	font-family: Calibri;
	text-align: center;
	background-color: #FFFFFF;
}
.auto-style17 {
	font-family: Calibri;
}
.auto-style18 {
	font-family: Calibri;
	text-align: center;
}
.auto-style19 {
	text-decoration: underline;
	font-size: xx-small;
	color: #0000FF;
}
.auto-style20 {
	font-size: xx-small;
}
.auto-style21 {
	font-size: xx-small;
	color: #000000;
}
</style>
</head>
<body>
<table cellpadding="0" cellspacing="0" style="width: 524px">
	<tr>
		<td class="auto-style15" style="width: 262px"><strong>SIGN IN</strong></td>
		<td class="auto-style15" style="width: 262px"><strong>REGISTER</strong></td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px">EMAIL </td>
		<td class="auto-style1" style="width: 262px">EMAIL </td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px"><font size="2">
				<strong>
				{{ Form::open(['role' => 'form'],array('fromdata'=>$from)) }}
				
				{{ Form::text('emailsignin', null, ['id' =>'emailsignin' ,'size' => '46','class' => 'auto-style17','style'=>'width: 213px;']) }}</strong></font></td>
		<td class="auto-style1" style="width: 262px"><font size="2">
				<strong>
				{{ Form::email('email', null, ['id' =>'email' ,'size' => '46','class' => 'auto-style17','style'=>'width: 213px;']) }}</strong></font></td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px">PASSWORD</td>
		<td class="auto-style1" style="width: 262px">CONFIRM EMAIL</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px"><font size="2">
				<strong>
				{{ Form::password('regpassword', ['size' => '46','class' => 'auto-style17','style'=>'width: 213px;']) }}</strong></font></td>
		<td class="auto-style1" style="width: 262px"><font size="2">
				<strong>
				{{ Form::email('confirmemail', null, ['id' =>'confirmemail' ,'size' => '46','class' => 'auto-style17','style'=>'width: 213px;']) }}</strong></font></td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px"><span class="auto-style20">
		Forgot password? Enter email, and click </span>
		<span class="auto-style19">reset</span><span class="auto-style21">.</span></td>
		<td class="auto-style1" style="width: 262px">PASSWORD</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px">&nbsp;</td>
		<td class="auto-style1" style="width: 262px"><font size="2">
				<strong>
				{{ Form::password('password', ['id' =>'password' ,'size' => '46','class' => 'auto-style17','style'=>'width: 213px;']) }}</strong></font></td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px">&nbsp;</td>
		<td class="auto-style1" style="width: 262px">CONFIRM PASSWORD</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px">&nbsp;</td>
		<td class="auto-style1" style="width: 262px"><font size="2">
				<strong>
				{{ Form::password('confirmpassword', ['id' =>'confirmpassword' ,'size' => '46','class' => 'auto-style17','style'=>'width: 213px;']) }}</strong></font></td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px">&nbsp;</td>
		<td class="auto-style1" style="width: 262px">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 262px"><strong>
		{{ Form::submit('SIGN IN', ['class' => 'auto-style17']) }}
</strong></td>
		<td class="auto-style1" style="width: 262px">
		<input id="register" type="button" value="REGISTER" class="auto-style17"></td>
	</tr>
	{{ Form::close() }}
	<tr>
		<td class="auto-style18" style="width: 262px">&nbsp;</td>
		<td class="auto-style18" style="width: 262px">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style18" style="width: 262px">&nbsp;</td>
		<td class="auto-style18" style="width: 262px">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style18" style="width: 262px">&nbsp;</td>
		<td class="auto-style18" style="width: 262px">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style15" style="width: 262px">&nbsp;</td>
		<td class="auto-style15" style="width: 262px">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style15" style="width: 262px">&nbsp;</td>
		<td class="auto-style15" style="width: 262px">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style15" style="width: 262px">&nbsp;</td>
		<td class="auto-style15" style="width: 262px">&nbsp;</td>
	</tr>
</table>
<p class="auto-style17">&nbsp;</p>

</body>
<script type="text/javascript">
$("#register").click(function() 
{
	var email = $('#email').val();
	var confemail = $('#confirmemail').val();
	var pwd = $('#password').val();
	var confpwd = $('#confirmpassword').val();
	//alert(confemail);
	//alert(pwd);
	//alert(confpwd);
	if(email == confemail && pwd == confpwd)
	{
		$.ajax(
					{
				
						type: "POST",
						
						cache: false,
						
						data : {"email":email, "pwd":pwd},
						
						url: "/user/register",
											
						success: successmsg,
						
						error: errorAlert
				
			});
	}
	else
	{
		alert('Invalid credentials');
	}	
		function errorAlert(e, jqxhr)
		{
		//	window.location = "/login/searchresults"; 
			//alert("Please log in as registered user to access this feature");
		alert("Your request was not successful: " + jqxhr);
		
		}
		function successmsg()
		{
			alert('success!');
			window.location = "/"; 
		}
});
</script>
</html>
