<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 12.0">
<meta name="ProgId" content="FrontPage.Editor.Document">

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
<style type="text/css">
.auto-style7 {
	background-color: #FFFFFF;
	white-space: nowrap;
	font-size: small;
}
.auto-style16 {
	text-align: center;
	background-color: #504D47;
}
.auto-style34 {
	background-color: #504D47;
}
.auto-style40 {
	background-color: #FFFFFF;
	text-align: right;
	font-family: Calibri;
	font-size: medium;
}
.auto-style44 {
	text-align: center;
	background-color: #504D47;
	font-family: Calibri;
	color: #FFFFFF;
	font-size: medium;
}
.auto-style54 {
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style56 {
	text-align: right;
	font-family: Calibri;
	font-size: medium;
}
.auto-style75 {
	text-align: left;
}
.auto-style76 {
	background-color: #FFFFFF;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
}
.auto-style77 {
	white-space: normal;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	background-color: #FFFFFF;
}
.auto-style78 {
	font-family: Calibri;
	font-size: medium;
}
.auto-style79 {
	color: #FF0000;
}
.auto-style15 {
	font-family: Calibri;
	font-size: small;
	<!--text-transform: uppercase; -->
}

</style>
</head>

<body topmargin="0" leftmargin="0">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57197675-1', 'auto');
  ga('send', 'pageview');

</script>
<div class="auto-style75">
</table>
<table cellpadding="0" cellspacing="0" style="width: 100%; position:fixed;  background-color:#504D47; z-index:10;">
	<tr>
		<td class="auto-style34" style="width: 25%; height: 54px"></td>
		<td class="auto-style16" style="height: 54px">
		<a href="/">{{ HTML::image('img/WorldCourts_Logo.gif', 'Mistminds: International Case Law and Treaties Database', array('class' => 'auto-style78')) }}</a>
		<td class="auto-style44" style="width: 26%; height: 54px"><a style="color:#fff;font-weight:bold;font-size:17px;cursor:pointer;" id="admin_logout" >sign out</a>&nbsp;</td>
		
	</tr>
	<tr>
		<td class="auto-style7" style="width: 20%" colspan="3">
		<input type="hidden" name="currentlink" id="currentlink" value="1">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr style="bottom-margin:1in;">
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style76">
				<strong >
				
				<a id="newdocument"  href="/admin/document/create">NEW DOCUMENT</a> | <a id="internallink"  href="/admin/reference">INTERNAL LINKS</a> | 
				<a id="editdocument"  href="/admin/document/editindex">EDIT DOCUMENT</a> @if(Auth::user()->role == '1')| <a id="fieldsettings"  href="/admin/fieldsettings">FIELD SETTINGS</a> | <a id="users"  href="/admin/user">USERS</a> | <a id="usernotifications" href="/admin/usernotification">USER NOTIFICATIONS</a> | 
				<a id="userstatistics"  href="/admin/statistics">USER 
				STATISTICS</a> @endif</strong>
				</td>
				<td class="auto-style77" style="width: 5%"></td>
			</tr>
			<tr style="height:1em;">
				<td>
				
				</td>
			</tr>
			
		</table>
		</td>
	</tr>
	</table>
	 <table>
	 <div style="height:120px;"></div>
	@yield('content')
	</table>
	<!-- <p class="auto-style56">&nbsp;</p> -->
	

<script type="text/javascript">
		$(document).ready(function(){
		
	var currentlink = "{{ $_SESSION['currentlink'] }}";
			if(currentlink == 1)
		{
			$("#newdocument").css('color', 'red');
			//$("#currentlink").value(currentlink);
		}
		else if(currentlink == 2)
		{
			$("#internallink").css('color', 'red');
			//$("#currentlink").value(currentlink);
		}
		else if(currentlink == 3)
		{
			$("#editdocument").css('color', 'red');
			//$("#currentlink").value(currentlink);
		}
		else if(currentlink == 4)
		{
			$("#fieldsettings").css('color', 'red');
			//$("#currentlink").value(currentlink);
		}
		else if(currentlink == 5)
		{
			$("#users").css('color', 'red');
			//$("#currentlink").value(currentlink);
		}
		else if(currentlink == 6)
		{
			$("#usernotifications").css('color', 'red');
			//$("#currentlink").value(currentlink);
		}
		else if(currentlink == 7)
		{
			$("#userstatistics").css('color', 'red');
		//	$("#currentlink").value(currentlink);
		}
		else
		{
		
		}
});
		
		function changeLinkColor(linkno)
		{
			//alert('Hi..');
		//	alert(linkno);
		var currentlink = linkno;
			if(currentlink == 1)
		{
			$("#newdocument").css('color', 'red');
			//$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
		else if(currentlink == 2)
		{
			$("#internallink").css('color', 'red');
			//$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
		else if(currentlink == 3)
		{
			$("#editdocument").css('color', 'red');
		//	$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
		else if(currentlink == 4)
		{
			$("#fieldsettings").css('color', 'red');
			//$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
		else if(currentlink == 5)
		{
			$("#users").css('color', 'red');
			//$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
		else if(currentlink == 6)
		{
			$("#usernotifications").css('color', 'red');
			//$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
		else if(currentlink == 7)
		{
			$("#userstatistics").css('color', 'red');
			//$("#currentlink").value(currentlink);
			$('input:hidden[name="currentlink"]').val(currentlink);
		}
			//$("aid2").addClass("auto-style79");
		}
		
		function make_base_auth(user, password) {
		  var tok = user + ':' + password;
		  var hash = btoa(tok);
		  return "Basic " + hash;
		}
		$("#admin_logout").click(function(e){
				/*var xmlhttp;
				if (window.XMLHttpRequest) {
					  xmlhttp = new XMLHttpRequest();
				}
				// code for IE
				else if (window.ActiveXObject) {
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				if (window.ActiveXObject) {
				  // IE clear HTTP Authentication
				  document.execCommand("ClearAuthenticationCache");
				  window.location.href='/';
				} else {
					xmlhttp.open("GET", '/admin/logout', true, "logout", "logout");
					xmlhttp.send("");
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4) {window.location.href='/';}
					}
				}	*/
			$.ajax(
				{
					username: 'unknown',
					password: 'WrongPassword',
					url: '/admin/logout',
					type: 'GET',
					async: false,
					beforeSend: function(xhr)
					{
						xhr.setRequestHeader("Authorization", "Basic AAAAAAAAAAAAAAAAAAA=");
					},
					success: function(){
						window.location.href="/";
					},
					error: function(err)
					{
						window.location.href="/";
					}
			
				});
			});
</script>

</div>

</body>

</html>
