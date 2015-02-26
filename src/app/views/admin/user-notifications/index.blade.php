@extends('includes.adminHeader')
@section('content')

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 12.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>Mistminds | Admin | User Notifications</title>
<style type="text/css">
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
.auto-style80 {
	text-align: left;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style81 {
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style82 {
	text-align: left;
	font-family: Calibri;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style83 {
	text-align: center;
	font-family: Calibri;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style84 {
	font-family: Calibri;
}
.auto-style85 {
	font-family: Calibri;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style86 {
	text-align: left;
	font-family: Calibri;
}
.auto-style87 {
	font-size: small;
}
.auto-style88 {
	white-space: normal;
	text-align: center;
	font-family: Calibri;
	font-size: small;
	background-color: #FFFFFF;
}
</style>
</head>
		{{ Form::open(['role' => 'form', 'url' => '/admin/usernotification']) }}
		<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style40">
				&nbsp;</td>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style85">
				<strong>REGISTRATION EMAIL</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style81">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
			@if (array_key_exists('7', $notificationArray) == false)
			{{ Form::text('regsub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('regmsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@else
			{{ Form::text('regsub', $notificationArray[7]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('regmsg', $notificationArray[7]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style83">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style54">
				<p class="auto-style86"><strong>REGISTRATION CONFIRMATION EMAIL</strong></p>
				</td>
				
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style80">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
				@if(array_key_exists('1', $notificationArray) == false)
				{{ Form::text('getRegisterSubject', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
				{{ Form::textarea('getRegistermsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
				@else
				{{ Form::text('getRegisterSubject', $notificationArray[1]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
				{{ Form::textarea('getRegistermsg', $notificationArray[1]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
				@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style83">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style82">
				<strong>COVER EMAIL FOR SEARCH RESULTS DELIVERY</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style82">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td class="auto-style80">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
				@if(array_key_exists('2', $notificationArray) == false) 
				{{ Form::text('srchdeliverysub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
					<span class="auto-style87">MESSAGE<br></span>
				{{ Form::textarea('srchdeliverymsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				@else
				{{ Form::text('srchdeliverysub', $notificationArray[2]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
					<span class="auto-style87">MESSAGE<br></span>
				{{ Form::textarea('srchdeliverymsg', $notificationArray[2]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				@endif
			</tr>
			<tr>
				<td class="auto-style83">
				&nbsp;</td>
			</tr>
			</table>
				</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style82">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style82">
				<strong>COVER EMAIL FOR DOCUMENT DELIVERY</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style80">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
				@if(array_key_exists('3', $notificationArray) == false) 
				{{ Form::text('cntntdeliverysub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
					<span class="auto-style87">MESSAGE<br></span>
				{{ Form::textarea('cntntdeliverymsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
				@else
				{{ Form::text('cntntdeliverysub', $notificationArray[3]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
				{{ Form::textarea('cntntdeliverymsg', $notificationArray[3]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
				@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style83">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%"><strong></strong></td>
				<td class="auto-style85">
				<strong>PASSWORD RESET</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style80">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
			@if (array_key_exists('4', $notificationArray) == false) 
			{{ Form::text('pwdrstsub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('pwdrstmsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@else
			{{ Form::text('pwdrstsub', $notificationArray[4]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('pwdrstmsg', $notificationArray[4]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style83">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style85">
				<strong>ACCOUNT CLOSURE CONFIRMATION </strong>
				</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style80">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
			@if (array_key_exists('5', $notificationArray) == false) 
			{{ Form::text('accntclosureconfsub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('accntclosureconfmsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@else
			{{ Form::text('accntclosureconfsub', $notificationArray[5]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('accntclosureconfmsg', $notificationArray[5]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style83">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style85">
				<strong>BANNING CONFIRMATION</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style81">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
			@if (array_key_exists('6', $notificationArray) == false)
			{{ Form::text('banconfsub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('banconfmsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@else
			{{ Form::text('banconfsub', $notificationArray[6]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('banconfmsg', $notificationArray[6]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style83">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style85">
				<strong>RESEARCH TRAIL EMAIL</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td class="auto-style81">
				<span class="auto-style84">SUBJECT</span><font size="2" face="Calibri"><br class="auto-style87">
			@if (array_key_exists('8', $notificationArray) == false)
			{{ Form::text('researchtrailsub', null, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('researchtrailmsg', null, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@else
			{{ Form::text('researchtrailsub', $notificationArray[8]->subject, ['size' => '18', 'class' => 'auto-style15', 'style' => 'width: 612px; height: 21px;']) }}<br class="auto-style87">
				<span class="auto-style87">MESSAGE<br></span>
			{{ Form::textarea('researchtrailmsg', $notificationArray[8]->message, ['class' => 'auto-style15', 'style' => 'width: 612px; height: 305px;']) }}</font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			@endif
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td>
					{{ Form::submit('SAVE', ['id' => 'saveusernotifications']) }}
				</td>
			</tr>
			<tr>
				<td class="auto-style88" style="width: 5%">&nbsp;</td>
				<td>
					&nbsp;
				</td>
			</tr>
		{{ Form::close() }}
@endsection			