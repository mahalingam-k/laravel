@if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif
<table cellpadding="0" cellspacing="0"  bgcolor="#504D47" style="width: 100%; background-color:#504D47; position:fixed; top:0px; right:0px;z-index:999;">
			<tr>
				<td style="width: 5%;height:54px;" class="auto-style122">&nbsp;</td>
				<td style="width: 399px" class="auto-style122">&nbsp;</td>
				<td class=" " style="width: 399px" bgcolor="#504D47">
				<a href="/search">
		{{ HTML::image('/img/WorldCourts_Logo.gif', 'mistminds: International Case Law and Treaties Database', array('class' => 'auto-style78')) }} </a>
		</td>
				<td class="auto-style400" style="width: 399px">
		@if(isset(Auth::user()->role)==false)
			<strong><a id="register" href="#" style="color:#fff; font-weight:bold;font-size:17px;">register</a> &middot;
			<a id="signin" href="#" style="color:#fff;font-weight:bold;font-size:17px;">sign in</a> &middot;
		@endif
		<a id="researchtrail" href="#" style="color:#fff;font-weight:bold;font-size:17px;">research trail</a> 
		@if(isset(Auth::user()->role)==true)
			&middot; <a href="/user/logout" style="color:#fff;font-weight:bold;font-size:17px;">sign out</a>			
		@endif
		</strong><input type="hidden" id="isAuth" value="{{Auth::check()}}"/>
</td>
				<td style="width: 66px" class="auto-style122">&nbsp;</td>
				@if( isset($activePage) )
<ul class="nav nav-pills pull-center " id="main-menu">
    <li{{ ($activePage == 'simple') ? ' class="active"' : '' }}><a href="/">Simple search</a></li>
    <li{{ ($activePage == 'advanced') ? ' class="active"' : '' }}><a href="/advanced-search">Advanced search</a></li>
    <li{{ ($activePage == 'browse') ? ' class="active"' : '' }}><a href="/browse">Browse</a></li>
</ul>
@endif
			</tr>
		</table>

		<script type="text/javascript">
		function create( template, vars, opts ){
	return $container.notify("create", template, vars, opts);
}
		$(document).ready(function(){
		var alreadyconfirmed = "{{ Session::get('alreadyconfirmed') }}";
		var registrationconfirm = "{{ Session::get('userconfirmed') }}";
		var unsetalert = 	"{{ Session::get('unsetalert') }}";
		var passwordresetted = "{{ Session::get('passwordresetted') }}"; 
		var reset = "{{ Session::get('reset') }}";
		if(reset == 'yes')
		{
			$('#deleteForm').prop('action', 'aa');
				$('#deletePageName').text('bb');

				$('#modal-reset').modal({
					show: true
				});
		}
		if(unsetalert == 'yes')
		{
			$('#deleteForm').prop('action', 'aa');
				$('#deletePageName').text('bb');

				$('#modal-unsetalert').modal({
					show: true
				});
		}
			if(alreadyconfirmed == 'yes')
			{
				$("#AlreadyConfirm").show();
				$("#RegisterConfirm").hide();
				$('#deleteForm').prop('action', 'aa');
				$('#deletePageName').text('bb');

				$('#modal-login').modal({
					show: true
				});
			}
			if(registrationconfirm == 'yes')
			{
				$("#RegisterConfirm").show();
				$("#AlreadyConfirm").hide();
				$('#deleteForm').prop('action', 'aa');
				$('#deletePageName').text('bb');

				$('#modal-login').modal({
					show: true
				});
			}
			if(passwordresetted == 'yes')
			{
				$("#RegisterConfirm").hide();
				$("#AlreadyConfirm").hide();
				$("#ResetPassword").show();
				
				$('#deleteForm').prop('action', 'aa');
				$('#deletePageName').text('bb');

				$('#modal-login').modal({
					show: true
				});
			}
		});
		
$("#signin").click(function() 
{
		$('#loginmsgfield').html('');
		//alert('signin clicked');
 $('#deleteForm').prop('action', 'aa');
            $('#deletePageName').text('bb');

            $('#modal-login').modal({
                show: true
            });
 }); 
 
 $("#register").click(function() 
{
		
		//alert('signin clicked');
 $('#deleteForm').prop('action', 'aa');
            $('#deletePageName').text('bb');

            $('#modal-register').modal({
                show: true
            });
 });
 
$("#researchtrail").click(function() 
{
	if($("#isAuth").val())
	{
		window.location.href= "/user/researchtrail";
	}
	else
	{
		//$.growl.notice({ message: "The kitten is cute!" });
		$container = $("#container").notify();
				create("default", { title:'Research Trail', text:'Please Sign In to use this function. Registration is free and takes less than a minute.'});
		//alert('Please sign in or sign up to access this feature');
	}
});

</script>
	<div id="container" style="display:none">
		<div id="default">
			<h1>#{title}</h1>
			<p>#{text}</p>
		</div>
	</div>	
	<form>
	<div align="center" class="modal fade" id="modal-unsetalert" tabindex="-1" role="dialog" aria-labelledby="unsetalert" aria-hidden="true">
        <div class="modal-dialog" align="center">
            <div class="modal-content">
				<div class="modal-header">
					<button id="closesignin" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<table cellpadding="0" cellspacing="0" style="width: 524px">
					<tr align="center">
						<td class="auto-style15" style="width: 262px"><strong>Unset Alert</strong></td>
						
					</tr>
					<tr align="center">
						<td>
							<div id="alerts" >
							<font size="1" color="red">You have unsubscribed alerts.</font>
							</div>
							
						</td>
					</tr>
					<tr align="center">
						
						<td style="width: 262px">&nbsp;&nbsp;</td>
					</tr>
				</table>
            </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
    </div>
	
	<div id="dialog-delete-confirm"  title="Empty the recycle bin?" >
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please confirm that you want to DELETE your account with Mistminds?</p>
	</div>
	
	<div align="center" class="modal fade" id="modal-login"  tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog" align="center">
            <div class="modal-content">
				<div class="modal-header">
					<button id="closesignin" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<table cellpadding="0" cellspacing="0" style="width: 524px">
					<tr align="center">
						<td class="auto-style15" style="width: 262px"><strong>SIGN IN</strong></td>
						
					</tr>
					<tr align="center">
						<td>
							<div id="RegisterConfirm" style="display: none">
							<font size="1" color="red">Thank you for confirming your email address. Please sign in</font>
							</div>
							<div id="AlreadyConfirm" style="display: none">
							<font size="1" color="red">This email address has already been confirmed. Please sign in.</font>
							</div>
							<div id="ResetPassword" style="display: none">
							<font size="1" color="red">Thank you for resetting the password. You can now sign in.</font>
							</div>
						</td>
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px">EMAIL </td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><font size="2">
								<strong>
								
								{{ Form::open(array('method' => 'POST', 'id' => 'login-form', 'url' => '/login/searchmain')) }}
								
								{{ Form::text('emailsignin', null, ['id' =>'emailsignin' ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px">PASSWORD</td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><font size="2">
								<strong>
								{{ Form::password('regpassword', ['id'=>'regpassword', 'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><span class="auto-style20">
						Forgot password? Enter email, and click </span>
						<span class="auto-style19"><a href="#" id="reset" name="reset">reset</a></span><span class="auto-style21">.</span></td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><span class="auto-style20">
						Delete Account? Enter email and password, and click </span>
						<span class="auto-style19"><a href="#" class="confirm" id="deleteaccount" name="reset">delete</a></span><span class="auto-style21">.</span></td>
						
					</tr>
					<tr align="center">
						
						<td style="width: 262px"><font size="1">By pressing "Sign In" you agree to the <a href="/termsandconditions">terms and conditions</a> of using this service</font></td>
					</tr>
					<tr align="center">
						
						<td class="auto-style1" style="width: 262px">&nbsp;</td>
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><strong>
						<!--{{ Form::submit('SIGN IN') }} -->
						<input id="signinsave" type="button" value="SIGN IN" >
				</strong></td>
					</tr>
					<tr align="center">
							<td class="auto-style1" style="width: 262px">
							<div><font size="1" color="red"><p id="loginmsgfield"> </p></font></div></td>
					</tr>
					{{ Form::close() }}
					
				</table>
            </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
    </div>
	
	<div align="center" class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog" align="center">
            <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
					<table cellpadding="0" cellspacing="0" style="width: 524px">
						{{ Form::open(array('id' => 'register-form')) }}
						<tr align="center">
							<td class="auto-style15" style="width: 262px"><strong>REGISTER</strong></td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px">EMAIL </td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px"><font size="2">
									<strong>
									{{ Form::email('email', null, ['id' =>'email' ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px">CONFIRM EMAIL</td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px"><font size="2">
									<strong>
									{{ Form::email('confirmemail', null, ['id' =>'confirmemail' ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px">PASSWORD</td>
						</tr>
						<tr align="center">
							
							<td class="auto-style1" style="width: 262px"><font size="2">
									<strong>
									{{ Form::password('password', ['id' =>'password' ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
						</tr>
						<tr align="center">
							
							<td class="auto-style1" style="width: 262px">CONFIRM PASSWORD</td>
						</tr>
						<tr align="center">
							
							<td class="auto-style1" style="width: 262px"><font size="2">
									<strong>
									{{ Form::password('confirmpassword', ['id' =>'confirmpassword' ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
						</tr>
						<tr align="center">
							
							<td class="auto-style1" style="width: 262px">&nbsp;<div id="LoadingImage" style="display: none">
								{{ HTML::image('img/loader.gif', 'ajax loading image', array('height'=>'16','width'=>'16')) }}
							</div></td>
						</tr>
						<tr align="center">
							<td style="width: 262px">
							<font size="1">By pressing "Register" you agree to the <a href="/termsandconditions">terms and conditions</a> of using this service</font></td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px">
							<input id="registersave" type="button" value="REGISTER" ></td>
						</tr>
						<tr align="center">
							<td class="auto-style1" style="width: 262px">
							<div><font size="1" color="red"><p id="msgfield"> </p></font></div></td>
						</tr>
						{{ Form::close() }}
					</table>
            </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
    </div>
	
	<div align="center" class="modal fade" id="modal-reset"  tabindex="-1" role="dialog" aria-labelledby="reset" aria-hidden="true">
        <div class="modal-dialog" align="center">
            <div class="modal-content">
				<div class="modal-header">
					<button id="closesignin" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<table cellpadding="0" cellspacing="0" style="width: 524px">
					{{ Form::open(array('id' => 'register-form1')) }}
					<tr align="center">
						<td class="auto-style15" style="width: 262px"><strong>RESET PASSWORD</strong></td>
						
					</tr>
					
					<tr align="center">
						<td class="auto-style1" style="width: 262px">EMAIL </td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><font size="2">
								<strong>
								
								
								
								{{ Form::text('email',null,['id' =>'resetemail' ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px">PASSWORD</td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><font size="2">
								<strong>
								{{ Form::text('password',null,['id' =>'resetpwd'  ,'size' => '46','style'=>'width: 213px;']) }}</strong></font></td>
					</tr>
					
					<tr align="center">
						<td class="auto-style1" style="width: 262px">CONFIRM PASSWORD</td>
						
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><font size="2">
								<strong>
								{{ Form::text('password_confirmation', null,['id' =>'resetconfpwd' ,'size' => '46','style'=>'width: 213px;']) }}
								{{ Form::hidden('token', $_SESSION["resettoken"]) }}</strong></font></td>
					</tr>
					
					<tr align="center">
						
						<td class="auto-style1" style="width: 262px">&nbsp;</td>
					</tr>
					<tr align="center">
						<td class="auto-style1" style="width: 262px"><strong>
						
						<input id="submitresetbutton" type="button" value="SUBMIT" >
				</strong></td>
					</tr>
					<tr align="center">
							<td class="auto-style1" style="width: 262px">
							<div><font size="1" color="red"><p id="resetmsgfield"> </p></font></div></td>&nbsp;
						</tr>
					{{ Form::close() }}
					
				</table>
            </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
    </div>	
	
	<div id="basicModal">
    Please confirm that you want to DELETE your account with Mistminds?
</div>
</form>
<head>
<script type="text/javascript">
$("#signinsave").click(function()
 {
	
	var email = $('#emailsignin').val();
	var pwd = $('#regpassword').val();
	
	var fwdurl = document.URL;
	//alert(pwd);
	//alert(confpwd);
	if(email== '' || pwd == '')
	{
		//alert('Please enter all the values');
		$('#loginmsgfield').html('Please provide all the values.').style('text-color:red;');
	}
	else
	{
		
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		if (filter.test(email))
		{
			$("#LoadingImage").show();
			$.ajax(
					{
				
						type: "POST",
						
						cache: false,
						
						data : {"email":email, "pwd":pwd},
						
						url: "/login/searchmain",
											
						success: successsignin,
						
						error: errorsignin
				
			});
		}
		else{
		//alert("Please input a valid email address!")
		$('#loginmsgfield').html('Please enter a valid email address.').style('text-color:red;');
		}
	}
	

		function errorsignin(e, jqxhr)
		{
		//	window.location = "/login/searchresults"; 
			//alert("Please log in as registered user to access this feature");
		 $("#LoadingImage").hide();
		alert("Your request was not successful: " + jqxhr);
		
		}
		function successsignin(data)
		{
			 $("#LoadingImage").hide();
			// var errors = "{{$errors->has()}}";
			if(data=='notconfirmed')
			{
				
				$('#loginmsgfield').html('You have not confirmed your registration.Please check your email and confirm.').style('text-color:red;');
			}
			else if(data=='banned')
			{
				$('#loginmsgfield').html('User is banned.').style('text-color:red;');
			}
			else if(data=='invalidcredentials')
			{
				$('#loginmsgfield').html('This user name/password combination is incorrect.').style('text-color:red;');
			}
			else
			{
				var finalurl = (location.pathname+location.search).substr(1);
				//alert(finalurl);
				window.location.href = "/"+finalurl;
				
			}
		} 
});

$("#submitresetbutton").click(function()
 {
	//alert('inside');
	var resettoken="{{$_SESSION['resettoken']}}";
	var resetemail = $('#resetemail').val();
	var resetpwd = $('#resetpwd').val();
	var resetconfpwd = $('#resetconfpwd').val();
	 
	//alert(resettoken+' '+resetemail+' '+resetpwd+' '+resetconfpwd); 
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
	if (filter.test(resetemail))
	{
		if(resetpwd == resetconfpwd)
		{
			
			$.ajax(
						{
					
							type: "POST",
							
							cache: false,
							
							data : {"email":resetemail, "pwd":resetpwd,"confpwd":resetconfpwd,"token":resettoken},
							
							url: "password/reset/"+resettoken,
												
							success: successresetpwd,
							
							error: errorresetpwd
					
				});
				function errorresetpwd(e, jqxhr)
			{
			
			alert("Your request was not successful: " + jqxhr);
			
			}
			function successresetpwd()
			{
				
					$('#modal-reset').css('display','none');
					$('.modal-backdrop.in').css('opacity','0');
					$('.ui-widget-overlay').css('background','initial');
					$("#RegisterConfirm").hide();
					$("#AlreadyConfirm").hide();
					$("#ResetPassword").show();
					
					$('#deleteForm').prop('action', 'aa');
					$('#deletePageName').text('bb');

					$('#modal-login').modal({
						show: true
					});
				
			} 
		}
		else
		{
			$('#resetmsgfield').html('Password and Confirm Password does not match.').style('text-color:red;');
		}
	}
	else
	{
		$('#resetmsgfield').html('Please enter a valid email address.').style('text-color:red;');
	}
		
});

$("#registersave").click(function()
 {
	
	var email = $('#email').val();
	var confemail = $('#confirmemail').val();
	var pwd = $('#password').val();
	var confpwd = $('#confirmpassword').val();
	//alert(confemail);
	//alert(pwd);
	//alert(confpwd);
	if(email== '' || confemail == '' || pwd == '' || confpwd == '')
	{
		//alert('Please enter all the values');
		$('#msgfield').html('Please provide all the values.').style('text-color:red;');
	}
	else if(email == confemail && pwd == confpwd)
	{
		
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		if (filter.test(email))
		{
			$("#LoadingImage").show();
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
		else{
		//alert("Please input a valid email address!")
		$('#msgfield').html('Please enter a valid email address.').style('text-color:red;');
		}
	}
	else
	{
		//alert('Invalid credentials');
		$('#msgfield').html('Email or Password values does not match with the Confirmation Email or Confirmation Password respectively.').style('text-color:red;');
	}
	
		
		function errorAlert(e, jqxhr)
		{
		//	window.location = "/login/searchresults"; 
			//alert("Please log in as registered user to access this feature");
		 $("#LoadingImage").hide();
		alert("Your request was not successful: " + jqxhr);
		
		}
		function successmsg(data)
		{
			 $("#LoadingImage").hide();
			if(data=='banned')
			{
				
				$('#msgfield').html('User is banned.').style('text-color:red;');
			}
			else if(data=='registered')
			{
				$('#msgfield').html('User is already registered.').style('text-color:red;');
			}
			else
			{
				//alert('success!');
				$('#msgfield').html('Thank you for registering. To confirm your email address please click on the link in the confirmation email sent to you.');
			}
			
		} 
});

$("#reset").click(function()
 {
	var email = $('#emailsignin').val();
	if(email == '')
	{
		alert('Please enter email address');
	}
	else
	{
		// alert('inside else part');
		$.ajax(
					{
				
						type: "POST",
						
						cache: false,
						
						data : {"email":email},
						
						url: "password/reset",
											
						success: successreset,
						
						error: errorReset
				
		});
		function successreset(data)
		{
			
			if(data == 'invaliduser')
			{
				$('#loginmsgfield').html('User does not exist.').style('text-color:red;');
			}
			else
			{
				$('#loginmsgfield').html('An email with the password reset has been sent.').style('text-color:red;');
				//alert('An email with the password reset has been sent.');
				window.location = "/"; 
			}
		}
		function errorReset(e, jqxhr)
		{
		//	window.location = "/login/searchresults"; 
			//alert("Please log in as registered user to access this feature");
		alert("Your request was not successful: " + jqxhr);
		
		}
	}
	
			
 });
 

 
 $("#deleteaccount").click(function()
 {
	
	//$('#modal-login').css('display','none');
	//$('.modal-backdrop.in').css('opacity','0');
	//$('.ui-widget-overlay').css('background','initial');
	var email = $('#emailsignin').val(); 
	var pwd = $('#regpassword').val();
	
	if(email == '' || pwd == '')
	{
		//alert('Please enter email address and password');
		$('#loginmsgfield').html('Please enter email address and password.').style('text-color:red;');
	}
	else
	{
		var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
		if (filter.test(email))
		{
			var txt;
			var r = confirm("Please confirm that you want to DELETE your account with Mistminds?");
			if (r == true) 
			{
					$.ajax(
								{
							
									type: "POST",
									
									cache: false,
									
									data : {"email":email,"pwd":pwd},
									
									url: "user/deleteaccount",
														
									success: successdelete,
									
									error: errorDelete
							
					});
					function successdelete(data)
					{
						
						//alert('success');
						if(data == 'invaliduser')
						{
							$('#loginmsgfield').html('Invalid User email and Password.').style('text-color:red;');
						}
						else
						{
							$('#loginmsgfield').html('User Account is deleted successfully.').style('text-color:red;');
						//	$('#emailsignin').val('');
							$('input:text[name="emailsignin"]').val('');
						//	$('#regpassword').val('');
							$('input:text[name="regpassword"]').val('');
							//alert('An email with the password reset has been sent.');
						//	window.location = "/"; 
						}
					}
					function errorDelete(e, jqxhr)
					{
					//	window.location = "/login/searchresults"; 
						//alert("Please log in as registered user to access this feature");
					alert("Your request was not successful: " + jqxhr);
					
					}
			} 
			else 
			{
			
			}
		}
		else
		{
			$('#loginmsgfield').html('Please enter valid email address.').style('text-color:red;');
		}
	}

	
	/*$('#modal-login').modal({
                show: true
            });	*/
	
	 
	/*
	$( "#dialog-delete-confirm" ).dialog({
      resizable: false,
      height:250,
	  width:400,
      modal: true,
      buttons: {
        "Delete Account": function() {
		alert('yes');
          $( this ).dialog( "close" );
        },
        Cancel: function() {
		alert('no');
          $( this ).dialog( "close" );
        }
      }
    }); */
 });
 
 
 $("#closesignin").click(function() 
{
	window.location.href="/";
});
</script>
</head>