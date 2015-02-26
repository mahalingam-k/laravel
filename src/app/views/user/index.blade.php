
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 12.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>Mistminds | Admin | Users</title>
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
#pagin li { 
display: inline; 
padding: 1px;
}
.auto-style7 {
	background-color: #FFFFFF;
	white-space: nowrap;
	font-size: small;
}
.auto-style16 {
	text-align: center;
	background-color: #666666;
}
.auto-style34 {
	background-color: #666666;
}
.auto-style40 {
	background-color: #FFFFFF;
	text-align: right;
	font-family: Calibri;
	font-size: medium;
}
.auto-style44 {
	text-align: center;
	background-color: #666666;
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
.auto-style80 {
	font-size: medium;
}
.auto-style15 {
	font-family: Calibri;
	font-size: medium;
	text-transform: uppercase;
}
.auto-style82 {
	text-align: right;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style83 {
	white-space: normal;
	text-align: center;
	font-family: Calibri;
	font-size: x-small;
	background-color: #FFFFFF;
}
.auto-style84 {
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: x-small;
	background-color: #FFFFFF;
}
.auto-style85 {
	text-align: right;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: x-small;
	background-color: #FFFFFF;
}
.auto-style86 {
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: x-small;
	background-color: #C0C0C0;
	text-decoration: underline;
}
.auto-style87 {
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: x-small;
	background-color: #C0C0C0;
}
.auto-style88 {
	white-space: normal;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	background-color: #666666;
}
.auto-style89 {
	background-color: #666666;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
}
.auto-style90 {
	background-color: #FFFFFF;
	text-align: right;
	font-family: Calibri;
	font-size: medium;
	text-decoration: underline;
}

</style>
</head>

<header class="row">
        @include('includes.adminHeader')
    </header>
	<div style="width:100%; height:80px">&nbsp;</div>
<table id="tbl" cellpadding="0" cellspacing="0" style="width: 1329px">
			@if (Session::has('ban'))
    <div class="alert alert-info">{{ Session::get('ban') }}</div>
@endif

			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style40" colspan="7">
				&nbsp;</td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style54" colspan="7">
				<p class="auto-style80"><strong><a id="a" href="/admin/user/searchbycharacter/a">A</a> <a id="b" href="/admin/user/searchbycharacter/b">B</a> <a id="c" href="/admin/user/searchbycharacter/c">C</a> <a id="d" href="/admin/user/searchbycharacter/d">D</a> <a id="e" href="/admin/user/searchbycharacter/e">E</a> <a id="f" href="/admin/user/searchbycharacter/f">F</a> <a id="g" href="/admin/user/searchbycharacter/g">G</a> <a id="h" href="/admin/user/searchbycharacter/h">H</a> <a id="i" href="/admin/user/searchbycharacter/i">I</a> <a id="j" href="/admin/user/searchbycharacter/j">J</a> <a id="k" href="/admin/user/searchbycharacter/k">K</a>
				<a id="l" href="/admin/user/searchbycharacter/l">L</a> <a id="m" href="/admin/user/searchbycharacter/m">M</a> <a id="n" href="/admin/user/searchbycharacter/n">N</a> <a id="o" href="/admin/user/searchbycharacter/o">O</a> <a id="p" href="/admin/user/searchbycharacter/p">P</a> <a id="q" href="/admin/user/searchbycharacter/q">Q</a> <a id="r" href="/admin/user/searchbycharacter/r">R</a> <a id="s" href="/admin/user/searchbycharacter/s">S</a> <a id="t" href="/admin/user/searchbycharacter/t">T</a> <a id="u" href="/admin/user/searchbycharacter/u">U</a> <a id="v" href="/admin/user/searchbycharacter/v">V</a> <a id="w" href="/admin/user/searchbycharacter/w">W</a> <a id="x" href="/admin/user/searchbycharacter/x">X</a> <a id="y" href="/admin/user/searchbycharacter/y">Y</a> <a id="z" href="/admin/user/searchbycharacter/z">Z</a></strong></p>
				</td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style54" colspan="7">
				&nbsp;</td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style54" colspan="7">
				<font size="2" face="Calibri">
				{{ Form::open(['role' => 'form', 'url' => '/admin/user/find']) }}
			
			{{ Form::text('getUserName', $searchedUser, ['size' => '20', 'class' => 'auto-style15', 'style' => 'width: 419px; height: 27px']) }}
				<font face="Calibri" size="3">
	&nbsp;
	
	{{ Form::submit('FIND', ['class' => 'auto-style40', 'style' => 'width: 43px; height: 27px;']) }} </font></font></td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
				<div class='form-group'>
    {{ Form::close() }}    
    </div>

   
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style90" colspan="8">
				<a href="/admin/user/create">Add Staff User</a></td>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style54" colspan="7">
				&nbsp;</td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style54" colspan="7">
				<hr>
				</td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style82" colspan="7">
				<strong>
				<div id="pagin">
					<ul style="margin:0px;">
					@foreach($pagination as $index => $page)
						<li><a style="color:white;" href="{{ $page['link'] }}">{{ $page['label'] }}</a></li>
						
					@endforeach
					</ul>
					</div>
</strong></td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 66px">&nbsp;</td>
				<td class="auto-style54" colspan="7">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td class="auto-style77" style="width: 67px">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style83" style="width: 66px">&nbsp;</td>
				<td class="auto-style86" style="width: 165px">
				<strong>USER NAME/EMAIL</strong></td>
				<td class="auto-style86" style="width: 165px">
				<strong>LAST VISITED</strong></td>
				<td class="auto-style86" style="width: 165px">
				<strong>DOWNLOADS</strong></td>
				<td class="auto-style86" style="width: 165px">
				<strong>EMAILS</strong></td>
				<td class="auto-style86" style="width: 165px">
				<strong>VISITS/MONTH</strong></td>
				<td class="auto-style87" style="width: 166px">
				<strong>BAN</strong></td>
				<td class="auto-style87" style="width: 166px">
				DEL</td>
				<td class="auto-style83" style="width: 67px">&nbsp;</td>
			</tr>
			@foreach ($users as $user)
			<tr>
				<td class="auto-style83" style="width: 66px">&nbsp;</td>
				<td id="td1" class="auto-style84" style="width: 165px">
				{{  $user->email }}</td>
				<td id="td2" class="auto-style84" style="width: 165px">
				{{  $user->last_logged_in_time }}</td>
				<td id="td3" class="auto-style84" style="width: 165px">
				{{ $userDownloads[$user->id] }}</td>
				<td id="td4" class="auto-style84" style="width: 165px">
				{{ $userEmails[$user->id] }}</td>
				<td id="td5" class="auto-style84" style="width: 165px">
				{{ $visitsPerMonth[$user->id] }}</td>
				<td class="auto-style84" style="width: 166px">
				<font face="Calibri" size="3">
				<a href="/admin/user/ban/{{ $user->id }}" style="color:black;" ><input name="banUser" style="font-family: Calibri; " type="submit" value="BAN" class="auto-style85"></a></font></td>
				<td class="auto-style84" style="width: 166px">
				<font face="Calibri" size="3">
				<a href="/admin/user/del/{{ $user->id }}" style="color:black;" ><input name="deleteUser" style="font-family: Calibri; " type="submit" value="DEL" class="auto-style85"></a></font></td>
				<td class="auto-style83" style="width: 67px">&nbsp;</td>
			</tr>
			@endforeach
			<tr>
			<td>&nbsp;&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;&nbsp;</td>
			</tr>
			</table>
			
			<script type="text/javascript">
				$(document).ready(function(){
					//alert('doc ready');
					var v = "{{ $highlightLink }}";
					var p = '#'+v;
					//alert(p);
					$(''+p+'').attr('class', 'auto-style79');
					//alert(v);
				});
				
				function searchByCharacter(srchChar) 
				{ 
					//alert('Inside searchByCharacter');
					//alert(srchChar);
					$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					data : {"val":srchChar},
										
					url: "/admin/user/searchbycharacter" ,
										
					success: successmsg,
					
					error: errorAlert
			
				});
				
				}
				
		function errorAlert(e, jqxhr)
		{
		
		alert("Your request was not successful: " + jqxhr);
		
		}
		
		function successmsg(data)
		{
			alert(data);
			
			$.each(JSON.parse(data), function(idx, obj) {
	alert(idx);
	if(idx == 0)
	{
		$.each(obj, function(idx1, obj1) {
			alert(obj1.email);
		});
	}
	if(idx == 1)
	{
		alert();
	}
	
});
			for (var value in data) {
        //alert(data[value]);
    }
			//location.reload(); 
		}
				
			</script>
</html>

