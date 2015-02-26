@extends('layouts.frontend')

@section('content')
   
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 12.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>Mistminds</title>
<style type="text/css">
.auto-style5 {
	text-align: center;
	font-family: Calibri;
	color: #808080;
}
.auto-style7 {
	background-color: #FFFFFF;
}
.auto-style10 {
	text-align: center;
	font-family: Calibri;
	font-weight: bold;
	font-size: medium;
	text-transform: uppercase;
}
.auto-style16 {
	text-align: center;
	background-color: #666666;
}
.auto-style17 {
	background-color: #FFFFFF;
	font-family: Calibri;
	font-size: medium;
	color: #FF0000;
}
.auto-style18 {
	background-color: #FFFFFF;
	text-align: center;
}
.auto-style19 {
	background-color: #FFFFFF;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
}
.auto-style20 {
	background-color: #FFFFFF;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	color: #C0C0C0;
}
.auto-style22 {
	background-color: #FFFFFF;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	color: #FF0000;
}
.auto-style23 {
	background-color: #FFFFFF;
	text-align: left;
	font-family: Calibri;
	font-size: medium;
	color: #C0C0C0;
}
.auto-style24 {
	background-color: #FFFFFF;
	text-align: left;
	font-family: Calibri;
	font-size: medium;
}
.auto-style25 {
	background-color: #FFFFFF;
	text-align: left;
	font-family: Calibri;
	font-size: medium;
	color: #FF0000;
}
.auto-style12 {
	font-family: Calibri;
	font-size: medium;
}
.auto-style87 {
	text-align: center;
}
.auto-style88 {
	text-align: left;
	font-size: small;
}
.auto-style89 {
	font-size: medium;
	margin-left: 0in;
	margin-right: 0in;
}
.auto-style90 {
	text-align: center;
	font-size: small;
}
.auto-style91 {
	font-size: medium;
}
.auto-style92 {
	text-align: center;
	font-size: medium;
}
.auto-style93 {
	text-align: left;
	font-size: medium;
}
.auto-style96 {
	text-decoration: underline;
	font-size: medium;
	color: #FFFFFF;
}
.auto-style98 {
	background-color: #FFFFFF;
	font-family: Calibri;
	font-size: medium;
}
.auto-style99 {
	background-color: #FFFFFF;
	text-align: right;
	font-family: Calibri;
	font-size: medium;
}
.auto-style100 {
	background-color: #666666;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
}
.auto-style102 {
	font-size: medium;
	color: #FFFFFF;
}
.auto-style103 {
	background-color: #FFFFFF;
	color: #FFFFFF;
}
.auto-style104 {
	background-color: #666666;
	text-align: right;
	font-family: Calibri;
	font-size: medium;
	color: #FFFFFF;
}
.auto-style111 {
	
	text-align: left;
	font-family: Calibri;
	font-size: medium;
	
}
</style>
</head>

<body topmargin="0" leftmargin="0">

<form id="form1" runat="server">

<table cellpadding="0" cellspacing="0" style="width: 100%">
	
	<tr>
		<td class="auto-style7" style="width: 66px; "></td>
		<td class="auto-style7" style="height: 19px; " colspan="27"></td>
		<td class="auto-style7" style="width: 67px; "></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 66px; "></td>
		<td bgcolor="#FFFFFF" class="auto-style10" style="width: 90%">
				Help</td>
		<td class="auto-style7" style="width: 67px; "><br/><br/></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 66px; "></td>
		<td ><hr></td>
		<td class="auto-style7" style="width: 67px; "><br/><br/></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 5%; "></td>
		<td class="auto-style111" style="width:90%; " > {{ $footer[0]->content }} </td>
		<td class="auto-style7" style="width: 5%; "></td>
		
	</tr>
</table>
</form>

</body>

</html>
@endsection