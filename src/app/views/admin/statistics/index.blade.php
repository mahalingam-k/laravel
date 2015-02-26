<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 12.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>Mistminds | Admin | User Statistics</title>
<style type="text/css">
.auto-style1 {
	text-align: center;
	font-family: Calibri;
	font-size: medium;
}
.auto-style15 {
	font-family: Calibri;
	font-size: small;
	text-transform: uppercase;
}
.auto-style8 {
	font-size: small;
	text-transform: uppercase;
}
.auto-style16 {
	color: #FF0000;
}
.auto-style17 {
	font-family: Calibri;
	font-size: medium;
}
.auto-style18 {
	font-size: medium;
}
.auto-style20 {
	font-family: Calibri;
	font-size: medium;
	text-transform: uppercase;
}
.auto-style21 {
	font-family: Calibri;
	text-transform: uppercase;
}
</style>
</head>

@include('includes.adminHeader')
<div style="width:100%; height:60px">&nbsp;</div>
<body topmargin="0" leftmargin="0">
{{ Form::open(array('method' => 'POST', 'id' => 'stat-form', 'url' => '/admin/statistics/postStat')) }}
<p align="center" style="color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
<font face="Calibri" size="3">
{{ Form::select('Years', $cal[0], $dy )}}
	{{ Form::select('Months', $cal[1], $dm )}}
	{{ Form::select('Days', $cal[2], $dd )}}&nbsp;
	<span class="auto-style18">&nbsp;<input name="getstats" class="auto-style17" type="submit" value="Get Stats"></font></p>
	
	
<table border="0" cellpadding="0" cellspacing="0" style="font-family: 'Times New Roman'; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;" width="100%">
	<tr>
		<td align="left" bgcolor="#E2E2E2" colspan="11" width="113%"><b>
		<font face="Calibri">&nbsp;GENERAL ACTIVITY</font></b></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#C0C0C0" colspan="3" width="14%">
			<font face="Calibri" size="2"><b>for year/month</b></font></td>
			<td align="center" bgcolor="#C0C0C0" width="14%"><b>
			<font face="Calibri" size="2">SEARCHES</font></b></td>
			<td align="center" bgcolor="#C0C0C0" width="10%"><b>
			<font face="Calibri" size="2">OPENED</font></b></td>
			<td align="center" bgcolor="#C0C0C0" width="10%"><b>
			<font face="Calibri" size="2">EMAIL</font></b></td>
			<td align="center" bgcolor="#C0C0C0" width="10%"><b>
			<font face="Calibri" size="2">DOWNLOAD</font></b></td>
			<td align="center" bgcolor="#C0C0C0" width="10%"><b>
			<font face="Calibri" size="2">ALERTS</font></b></td>
			
	</tr>
	
	@foreach ($results as $index => $res)
		<tr>
			<td align="center" width="4%">
			<p align="center"><font face="Calibri" size="2">{{ date('Y', strtotime($res->act_on)) }}</font></p>
			</td>
			<td align="center" width="5%"><p><font face="Calibri" size="2">{{ date('m', strtotime($res->act_on)) }}</font></p></td>
			<td align="center" width="5%"><p><font face="Calibri" size="2">{{ date('d', strtotime($res->act_on)) }}</font></p></td>
			<td align="center" width="14%"><p><font face="Calibri" size="2">{{ $res->search }}</font></p></td>
			<td align="center" width="10%"><p><font face="Calibri" size="2">{{ $res->opened }} </font></p></td>
			<td align="center" width="10%"><p><font face="Calibri" size="2">{{ $res->email }} </font></p></td>
			<td align="center" width="10%"><p><font face="Calibri" size="2">{{ $res->download }} </font></p></td>
			<td align="center" width="10%"><p><font face="Calibri" size="2">{{ $res->alert }}</font></p></td>
			
		</tr>
		@endforeach
</table>
<p style="color:rgb(0,0,0);font-family:&#39;Times New Roman&#39;;font-size:medium;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px">
	<input name="exportsearch" type="submit" value="Export" class="auto-style17" style="margin-left:2%"> <font size="2">
				{{ Form::text('frmsrchdate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:98px')) }}</font><span> 
				TO </span><font size="2">
				{{ Form::text('endsrchdate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:98px')) }}</font></p>
	<hr style="color:rgb(0,0,0);font-family:&#39;Times New Roman&#39;;font-size:medium;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px">
	<p style="color:rgb(0,0,0);font-family:&#39;Times New Roman&#39;;font-size:medium;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px">
	 </p>
<table border="0" cellpadding="0" cellspacing="0" height="62" style="font-family: 'Times New Roman'; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;" width="100%">
	<tr>
		<td align="center" bgcolor="#E2E2E2" colspan="2" height="21" width="13%">
		<font face="Calibri" size="3"><b>
		<span style="text-transform: uppercase;">SEARCH TERM &amp; PHRASE POPULARITY</span></b></font></td>
		<td align="center" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
		<td align="center" bgcolor="#E2E2E2" colspan="2" height="21" width="13%">
		<font face="Calibri"><b><span style="text-transform: uppercase;">
		DOCUMENT POPULARITY</span></b></font></td>
	</tr>
	@if (count($searches)>count($docs))
		@foreach ($searches as $index => $search)
		<tr>
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<font face="Calibri" size="2" style="margin-left:4%">{{ $search->searchterm }}</font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2">{{ $search->srchcnt }}</font></td>
			<td align="left" bgcolor="#FFFFFF" height="21" width="2%"> </td>
			@if (count($docs)>$index)
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<font face="Calibri" size="2" style="margin-left:4%">{{ $docs[$index]->content }}</font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2">{{ $docs[$index]->doccnt }}</font></td>
			@else
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<font face="Calibri" size="2"></font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2"></font></td>
			@endif
		</tr>
		@endforeach
		@else
		@foreach ($docs as $index => $doc)
		<tr>
			@if (count($searches)>$index)
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<font face="Calibri" size="2">{{ $searches[$index]->searchterm }}</font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2">{{ $searches[$index]->srchcnt }}</font></td>
			<td align="left" bgcolor="#FFFFFF" height="21" width="2%"> </td>
			@else
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<font face="Calibri" size="2"></font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2"></font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2"></font></td>
			@endif
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<font face="Calibri" size="2">{{ $doc->content }}</font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%">
			<font face="Calibri" size="2">{{ $doc->doccnt }}</font></td>
			
		</tr>
		@endforeach
		@endif
	<tr>
		<td align="left" bgcolor="#FFFFFF" height="21" width="11%">&nbsp;</td>
		<td align="center" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
		<td align="left" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
		<td align="left" bgcolor="#FFFFFF" height="21" width="11%">&nbsp;</td>
		<td align="left" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF" height="21" width="11%">&nbsp;</td>
		<td align="center" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
		<td align="left" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
		<td align="left" bgcolor="#FFFFFF" height="21" width="11%">&nbsp;</td>
		<td align="left" bgcolor="#FFFFFF" height="21" width="2%">&nbsp;</td>
	</tr>
	<tr>
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<input name="exportpopularsearchterms" type="submit" value="Export" class="auto-style17" style="margin-left:2%"> <font size="2">
				{{ Form::text('frmpopularststartdate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:99px')) }}
				</font><span> 
				TO </span><font size="2">
				{{ Form::text('topopularstenddate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:99px')) }}
				</font></td>
			<td align="center" bgcolor="#FFFFFF" height="21" width="2%"> </td>
			<td align="left" bgcolor="#FFFFFF" height="21" width="2%"> </td>
			<td align="left" bgcolor="#FFFFFF" height="21" width="11%">
			<input name="exportpopulardocuments" type="submit" value="Export" class="auto-style17"> <font size="2">
				{{ Form::text('frmpopulardocstartdate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:99px')) }}</font><span> 
				TO </span><font size="2">
				{{ Form::text('topopulardocenddate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:99px')) }}</font></td>
			<td align="left" bgcolor="#FFFFFF" height="21" width="2%"> </td>
		</tr>
</table>
<p style="color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
&nbsp;</p>
<hr style="color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
<p style="color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
&nbsp;</p>
<table border="0" cellpadding="0" cellspacing="0" style="font-family: 'Times New Roman'; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;" width="100%">
	<tr>
		<td align="left" bgcolor="#E2E2E2" width="6%">
		<font face="Calibri" size="3"><b>
		<span style="text-transform: uppercase;">USER STATISTICS</span></b></font></td>
	</tr>
	<tr>
		<td align="left" bgcolor="#FFFFFF" width="6%">&nbsp;</td>
	</tr>
	<tr>
			<td align="left" bgcolor="#FFFFFF" width="6%">
			<input name="exportuserstats" type="submit" value="Export" class="auto-style17" style="margin-left:2%"> <font size="2">
				{{ Form::text('frmuserstatstartdate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:99px')) }}</font><span> 
				TO </span><font size="2">
				{{ Form::text('enduserstatstartdate', null, array('size' => 18, 'placeholder' => 'YYYY/MM/DD', 'style' => 'width:99px')) }}</font></td>
	</tr>
</table>
<p style="color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
&nbsp;</p>

<p>&nbsp;</p>

<p>&nbsp;</p>
{{ Form::close() }}

</body>

</html>
