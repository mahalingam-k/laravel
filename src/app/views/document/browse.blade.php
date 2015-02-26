@extends('layouts.frontend')

@section('content')
   
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 12.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title>{{ $institution->name }} | Mistminds</title>
<style type="text/css">
.auto-style5 {
	text-align: center;
	font-family: Calibri;
	color: #808080;
}
.auto-style7 {
	background-color: #FFFFFF;
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
</style>
</head>

<body topmargin="0" leftmargin="0">

<form id="form1" runat="server">

<table cellpadding="0" cellspacing="0" style="width: 100%" >
	
	<tr>
		<td class="auto-style7" style="width: 66px; "></td>
		<td class="auto-style7" style="height: 19px; " colspan="27"></td>
		<td class="auto-style7" style="width: 67px; "></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 66px; height: 19px;"></td>
		<td class="auto-style17" style="height: 19px; " colspan="27"><strong>
		{{ $institution->name }} </strong></td>
		<td class="auto-style7" style="width: 67px; height: 19px;"></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 66px; "></td>
		<td class="auto-style98" colspan="27"></td>
		<td class="auto-style7" style="width: 67px; "></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 66px; ">&nbsp;</td>
		<td>
			<table>
			<tr>
			@foreach ($years as $ind => $year)
				@if($year['active'] == true)
					<td class="auto-style24" style="height: 19; width: 47px"><strong><a href="{{ $year['link'] }}">{{ $year['year'] }}</a>&nbsp;&nbsp;</td>
				@else
					<td class="auto-style24" style="height: 19; width: 47px"><strong>{{ $year['year'] }}&nbsp;&nbsp;</td>
				@endif
			@if(($ind+1)%10 == 0)
			</tr>
			<tr>
			@endif
			@endforeach
			</tr>
			</table>
		</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;&nbsp;</td>
		<td>
			<!-- <table>
				<tr>
					<td class="auto-style19" style="height: 19; width: 47px"><strong>JAN&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>FEB&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>MAR&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>APR&nbsp;&nbsp;</strong></td>
					
				</tr>
				<tr>
					
					<td class="auto-style19" style="height: 19; width: 47px"><strong>MAY&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>JUN&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>JUL&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>AUG&nbsp;&nbsp;</strong></td>
					
				</tr>
				<tr>
					
					<td class="auto-style19" style="height: 19; width: 47px"><strong>SEP&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>OCT&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>NOV&nbsp;&nbsp;</strong></td>
					<td class="auto-style19" style="height: 19px; width: 47px"><strong>DEC&nbsp;&nbsp;</strong></td>
					
				</tr>
			</table>  -->
		</td>
		<td class="auto-style19" style="height: 19px; width: 47px">&nbsp;&nbsp;</td>
		<td class="auto-style19" style="height: 19px; width: 47px">&nbsp;&nbsp;</td>
		<td class="auto-style19" style="height: 19px; width: 47px">&nbsp;&nbsp;</td>
		<td>
			<!-- <table>
			<tr>
			@foreach ($alphabet as $char => $letter)
				<td class="auto-style99" style="height: 19; width: 47px"><strong><a href="{{ $letter['link'] }}">{{ $char }}</a></strong>&nbsp;&nbsp;</td>
			@if($char == 'I' || $char == 'R')
			</tr>
			<tr>
				@endif
			@endforeach
			</tr>
			</table> -->
		</td>
		<td class="auto-style7" style="width: 67px; ">&nbsp;</td>
	</tr>
	
	<tr>
		<td class="auto-style7" style="width: 66px; ">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style22" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style20" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style20" style="height: 19; width: 47px" colspan="2">&nbsp;</td>
		<td class="auto-style20" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style18" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style18" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style18" style="height: 19px; ">&nbsp;</td>
		<td class="auto-style18" style="height: 19px; ">&nbsp;</td>
		<td class="auto-style18" style="height: 19px; ">&nbsp;</td>
		<td class="auto-style18" style="height: 19px; ">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px" colspan="2">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 47px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 48px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 48px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 48px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 48px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 48px">&nbsp;</td>
		<td class="auto-style19" style="height: 19; width: 48px">&nbsp;</td>
		<td class="auto-style7" style="width: 67px; ">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style103" style="width: 66px; ">&nbsp;</td>
		<td class="auto-style100" style="height: 19px; " colspan="0">
				&nbsp;</td>
		<td class="auto-style100" style="height: 19px; " colspan="19">
				<span class="auto-style102">@include('includes.pagination')</span></td>
		<td class="auto-style104" style="height: 19px; " colspan="9">
				&nbsp; <!--email &middot; download -->&nbsp;&nbsp; </td>
		<td class="auto-style103" style="width: 67px; ">&nbsp;</td> 
	</tr>
	<tr>
		<td class="auto-style7" style="width: 66px; ">&nbsp;</td>
		<td class="auto-style24" style="height: 19; " colspan="27">
		
		@if (isset($resultset))

			<table cellpadding="0" cellspacing="0" style="width: 100%">
				<tr>
					
				@foreach ($tableHeader as $key => $headerColumn)
					@if($headerColumn['name']=='Title')
					<td class="auto-style18" style="height: 23; width: 45%">
						<strong><a href="{{ $headerColumn['link'] }}">
							{{ $headerColumn['name'] }}
							@if($sortParam == $key)
							<i class="fa {{ $headerColumn['cssClass'] }}"></i>
							@endif
						</a></strong>
					</td>
					@endif
					@if($headerColumn['name']=='Type')
					<td class="auto-style18" style="width: 38%; height: 23">
						<strong><a href="{{ $headerColumn['link'] }}">
							{{ $headerColumn['name'] }}
							@if($sortParam == $key)
							<i class="fa {{ $headerColumn['cssClass'] }}"></i>
							@endif
						</a></strong>
					</td>
					@endif
					@if($headerColumn['name']=='Date')
					<td class="auto-style18" style="height: 23; width: 10%">
						<strong><a href="{{ $headerColumn['link'] }}">
							{{ $headerColumn['name'] }}
							@if($sortParam == $key)
							<i class="fa {{ $headerColumn['cssClass'] }}"></i>
							@endif
						</a></strong>
					</td>
					@endif
				@endforeach
				</tr>
				

				@foreach ($resultset as $index => $document)
				<tr>
					<td class="auto-style93" style="height: 23; width: 45%"><a href="/document/{{$document->id}}?dctype={{ $document->type }}&ids={{$ids}}&hits=0" style="color:#000;"><o:p>{{ $document->search_title }}</o:p></a></td>
					<td class="auto-style87" style="width: 38%; height: 23">
					<p class=auto-style89 align=center style='mso-fareast-font-family: "Times New Roman";'>{{ ucfirst($document->document_type) }}<o:p></o:p>
					</p></td>
					<td class="auto-style92" style="height: 23; width: 10%">
					{{ Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE) }}
					<o:p></o:p></td>
					
				</tr>
				@endforeach
			</table>
		@endif

		</td>
		<td class="auto-style7" style="width: 67px; ">&nbsp;</td>
	</tr>
	</table>
</form>

</body>

</html>
@endsection