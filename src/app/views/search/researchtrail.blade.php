<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
@extends('layouts.frontend')
@section('content')

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-ca" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Mistminds | Your Research Trail</title>
<style type="text/css">

.auto-style5 {
	text-align: center;
	font-family: Calibri;
	color: #808080;
	font-size: medium;
}
.auto-style7 {
	background-color: #FFFFFF;
}
.auto-style9 {
	color: #FFFFFF;
	background-color: #FFFFFF;
}
.auto-style12 {
	font-family: Calibri;
	font-size: medium;
}
.auto-style16 {
	text-align: center;
	background-color: #666666;
}
.auto-style21 {
	text-align: center;
	color: #000000;
	background-color: #FFFFFF;
	font-family: Calibri;
	font-size: large;
}
.auto-style22 {
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: medium;
	text-align: center;
	background-color: #FFFFFF;
}
.auto-style24 {
	text-align: left;
	background-color: #FFFFFF;
}
.auto-style25 {
	text-align: left;
	color: #000000;
	background-color: #FFFFFF;
}
.auto-style26 {
	font-family: Calibri;
	font-size: medium;
	margin-left: 0px;
}
.auto-style27 {
	font-family: Calibri;
	font-size: medium;
	background-color: #FFFFFF;
}
.auto-style28 {
	font-family: Calibri;
	font-size: medium;
	color: #000000;
}
.auto-style32 {
	color: #FFFFFF;
	font-size: x-small;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	background-color: #FFFFFF;
}
.auto-style37 {
	font-size: large;
	font-family: Calibri;
	background-color: #FFFFFF;
}
.auto-style39 {
	text-align: center;
}
.auto-style40 {
	text-align: right;
	font-family: Calibri;
	color: #FFFFFF;
	font-size: medium;
}
.auto-style41 {
	color: #FFFFFF;
	font-size: medium;
	font-family: Calibri;
	background-color: #FFFFFF;
	text-align: right;
}
.auto-style44 {
	font-family: Calibri;
	font-size: medium;
	text-align: center;
	background-color: #FFFFFF;
}
.auto-style45 {
	color: #FFFFFF;
	background-color: #FFFFFF;
	font-family: Calibri;
	font-size: medium;
}
.auto-style48 {
	font-size: medium;
}
.auto-style51 {
	color: #FFFFFF;
	background-color: #FFFFFF;
	font-family: Calibri;
	font-size: large;
}
A {
	TEXT-DECORATION: none
}
.auto-style52 {
	font-family: Calibri;
}
.auto-style53 {
	font-family: Calibri;
	font-weight: bold;
}
.auto-style54 {
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	color: #000000;
	font-size: medium;
	text-align: left;
	background-color: #FFFFFF;
}
.auto-style55 {
	font-family: Calibri;
	color: #000000;
	font-size: large;
	background-color: #FFFFFF;
	text-align: left;
}
.auto-style56 {
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: medium;
	text-align: left;
	background-color: #FFFFFF;
}
.auto-style57 {
	color: #000000;
}
.auto-style58 {
	font-family: Calibri;
	color: #000000;
}
.auto-style59 {
	color: #000000;
	font-size: x-small;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	background-color: #FFFFFF;
}

.auto-style14 {
	text-align: center;
	background-color: #666666;
}
.auto-style15 {
	text-align: center;
}
.auto-style16 {
	text-align: left;
	font-family: Calibri;
	font-size: medium;
}
.auto-style17 {
	text-align: right;
	font-family: Calibri;
	font-size: medium;
}
.auto-style18 {
	font-family: Calibri;
	font-size: medium;
}
.auto-style19 {
	text-align: center;
	background-color: #FFFFFF;
}
.auto-style20 {
	text-align: left;
}
.auto-style12 {
	font-family: Calibri;
}
.auto-style21 {
	font-family: Calibri;
	font-size: medium;
	color: #808080;
}
.auto-style22 {
	color: #808080;
}
.auto-style23 {
	text-align: right;
	color: #FFFFFF;
	font-family: Calibri;
	background-color: #666666;
}
.auto-style24 {
	text-align: center;
	font-family: Calibri;
	font-size: medium;
}
.auto-style25 {
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	color: #FFFFFF;
	background-color: #666666;
}
.auto-style96 {
	text-decoration: underline;
}
.auto-style102 {
	font-size: medium;
	color: #FFFFFF;
}

.auto-style8 {
	font-size: medium;
	font-variant: normal;
}
.auto-style10 {
	text-align: center;
	font-family: Calibri;
	font-weight: bold;
	font-size: medium;
	text-transform: uppercase;
}
/*.auto-style17 {
	text-align: right;
	font-family: Calibri;
	
	font-size: medium;
}*/
.auto-style20 {
	text-align: right;
	font-size: xx-small;
	font-family: Calibri;
}
.auto-style104 {
	font-variant: normal;
}
.auto-style105 {
	font-family: Calibri;
	font-size: x-medium;
	
}
.auto-style107 {
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	background-color: #504D47;
}
.auto-style102 {
	font-size: medium;
	color: #FFFFFF;
}
.auto-style96 {
	text-decoration: underline;
	font-size: medium;
	color: #FFFFFF;
}
.auto-style108 {
	text-align: center;
	font-size: 18px;
}
.auto-style109 {
	text-align: center;
	font-size: 18px;
}
.auto-style110 {
	text-align: left;
}
.auto-style111 {
	text-align: left;
	 text-decoration:underline;
	color: #0000FF;
	font-family:calibri;
	font-size: 18px;

	
	
	
	
}
.auto-style112 {
	background-color: #FFFFFF;
}


</style>
</head>

<body style="margin: 0">
		<tr>
			<table border="0" width="100%" cellspacing="0" cellpadding="0" height="1" style="position:fixed;" >
			  <tr>
				<td bgcolor="#FFFFFF" height="21" style="width: 5%">&nbsp;</td>
				<td bgcolor="#FFFFFF" class="auto-style20" style="width: 90%" valign="top">&nbsp;
				</td>
				<td bgcolor="#FFFFFF" height="21" style="width: 5%">&nbsp;</td>
			  </tr>
			  <tr>
				<td bgcolor="#FFFFFF" height="21" style="width: 5%">&nbsp;</td>
				<td bgcolor="#FFFFFF" class="auto-style10" style="width: 90%">
				your research trail for the past month</td>
				<td bgcolor="#FFFFFF" height="21" style="width: 5%">&nbsp;</td>
			  </tr>
			  
				{{ Form::open(array('method' => 'GET', 'id' => 'researchtrail-form', 'url' => 'user/researchtrail/filter')) }}

			  <tr>
				<td bgcolor="#FFFFFF" style="height: 21px; width: 5%;"></td>
				<td bgcolor="#FFFFFF" class="auto-style17" style="width: 90%; height: 21px;">
				 <!-- <span class="auto-style104">&nbsp;</span><font size="2">{{ Form::text('from_date', $st_date, ['size' => '18', 'class' => 'auto-style105', 'placeholder' => '2010-12-01','style' => 'width: 98px; height: 18px;']) }} </font><span class="auto-style8"> 
						to </span><font size="2">
						{{ Form::text('to_date', $end_date, ['size' => '18', 'class' => 'auto-style105', 'placeholder' => '2010-12-25','style' => 'width: 96px; height: 18px;']) }}</font><span class="auto-style104"><strong style="color:black;font-family:calibri;font-weight:larze;">&nbsp; 
				  {{ Form::submit('view', array('style' => 'background-color:white;border:0px;padding:0;')) }} </strong>|-->
				  <a id="emailtrail" style="cursor:pointer;color:black;font-family:calibri;font-size:large"><strong>email</strong></a> &middot; 
				  <a id="deletetrail" style="cursor:pointer;color:black;font-family:calibri;font-size:large;"><strong>delete</strong></a></span></td>
				<td bgcolor="#FFFFFF" style="height: 21px; width: 5%;"></td>
			  </tr>
              
			  <tr>
				<td style="height: 21px; width: 5%;" class="auto-style112">&nbsp;</td>
				<td class="auto-style107" style="width: 90%; ">
							<span class="auto-style102">@include('includes.pagination')
							</span></td>
				<td style="height: 21px; width: 5%;" class="auto-style112">&nbsp;</td>
			  </tr>
              </table>
              <table  >
              <tr><td height="100px"></td></tr>
			  <tr>
				<td bgcolor="#FFFFFF" style="height: 21px; width: 5%;">&nbsp;</td>
				<td bgcolor="#FFFFFF" class="auto-style17" style="width: 90%; ">
				  <table cellpadding="0" cellspacing="0" style="width: 100%" id="research_tra">
					  <tr>
						  <td class="auto-style109" style="width: 179px"><strong>Date & Time</strong></td>
						  <td class="auto-style109" style="width: 988px"><strong>Search Strings</strong></td>
						  <td class="auto-style109"><strong>Hits</strong></td>
					  </tr>
					  <tr>
						  <td class="auto-style108" style="width: 179px">&nbsp;</td>
						  <td class="auto-style110" style="width: 988px">&nbsp;</td>
						  <td class="auto-style108">&nbsp;</td>
					  </tr>
					  @foreach ($stats as $index => $stat)
						<tr>
							<td class="auto-style108" style="width: 179px">{{ $stat->action_on }}</td>               
							<td class="auto-style111" style="width: 988px"><a href="/search?{{ $_SESSION['searchURL'][$index] }}">{{  $stat->content  }}</a></td>
							<td class="auto-style108">{{ $stat->document_count }}</td>				                
						</tr>
                         
					  @endforeach
					{{ Form::close() }}

				  </table>
				  </td>
				<td bgcolor="#FFFFFF" style="height: 21px; width: 5%;">&nbsp;</td>
			  </tr>
			  </table>

			<p>&nbsp;</p>

			<p>&nbsp;</p>
		
		</tr>

</body>
<script type="text/javascript">

function create( template, vars, opts ){
	return $container.notify("create", template, vars, opts);
}
	
		$("#emailtrail").click(function() 
		{
			$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					url: "/user/researchtrail/export?st_date={{$st_date}}&end_date={{$end_date}}",
										
					success: successmsg,
					
					error: errorAlert
			
				});
		
		});
		
		function errorAlert(e, jqxhr)
		{
		//	window.location = "/login/searchresults"; 
			//alert("Please log in as registered user to access this feature");
		alert("Your request was not successful: " + jqxhr);
		
		}
		
		function successmsg()
		{
			//alert('success!');
			$container = $("#container").notify();
			create("default", { title:'', text:'<center><font color="red">Research Trail Emailed.</font></center>'});
		}
		 
		$("#deletetrail").click(function() 
		{
			$.ajax(
			{
		
				type: "GET",
				
				cache: false,
				
				url: "/user/researchtrail/delete?st_date={{$st_date}}&end_date={{$end_date}}",
									
				success: successdownloadstat,
				
				error: errorAlert
		
			});
			
			function successdownloadstat()
			{
				$("#research_tra").hide();
				$container = $("#container").notify();
				create("default", { title:'', text:'<center><font color="red">Research Trail Deleted.</font></center>'});
			}
		
		}); 
		
	</script>

</html>
@endsection