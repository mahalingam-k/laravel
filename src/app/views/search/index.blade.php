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
	 
	 
	background-color: #FFFFFF;
}

 
</style>
</head>

<body topmargin="0" leftmargin="0">
 
{{ Form::open(array('method' => 'GET', 'id' => 'search-form', 'url' => '/search')) }}
	<tr >
		<td class="auto-style7" style="width: 20%; height: 19px"> </td>
		<td class="auto-style7" style="height: 19px; width: 25%"></td>
		<td class="auto-style27" style="width: 2%; height: 19px">&nbsp;</td>
		<td class="auto-style7" style="width: 42%; height: 19px"></td>
		<td class="auto-style7" style="width: 5%; height: 19px"></td>
	</tr><tr >
		<td class="auto-style7" style="width: 20%; height: 19px"> </td>
		<td class="auto-style7" style="height: 19px; width: 25%"></td>
		<td class="auto-style27" style="width: 2%; height: 19px">&nbsp;</td>
		<td class="auto-style7" style="width: 42%; height: 19px"></td>
		<td class="auto-style7" style="width: 5%; height: 19px"></td>
	</tr>	<tr>
		<td class="auto-style7" style="width: 20%; height: 19px"> </td>
		<td class="auto-style7" style="height: 19px; width: 25%"></td>
		<td class="auto-style27" style="width: 2%; height: 19px">&nbsp;</td>
		<td class="auto-style7" style="width: 42%; height: 19px"></td>
		<td class="auto-style7" style="width: 5%; height: 19px"></td>
	</tr>
	
	<tr>
		<td class="auto-style27" style="width: 20%; height: 22px;"></td>
		<td class="auto-style27" style="width: 25%; height: 22px;"></td>
		<td class="auto-style27" style="width: 2%; height: 22px;"></td>
		<td class="auto-style27" style="width: 42%; height: 22px;"></td>
		<td class="auto-style27" style="width: 5%; height: 22px;"></td>
	</tr>
	<tr style="margin:0%;">
		<td class="auto-style7" style="width: 20%; height: 18px;margin:0px; "></td>
		<td class="auto-style55" style="width: 25%; height: 18px;margin:0px;"><strong>{{ Form::label('q', 'TEXT', array('style' => 'margin:0%;'))}} </strong></td>
		<td class="auto-style32" style="width: 2%; height: 15px; margin:0px;" valign="top">
		</td>
		<td class="auto-style37" style="width: 42%; height: 15px; margin:0px;" valign="top">
		<strong>REFINE SEARCH BY DATABASE OR CLICK TO BROWSE</strong></td>
		<td class="auto-style7" style="width: 5%; height: 15px;margin:0px; "></td>
	</tr>
	<tr >
		<td class="auto-style27" style="width: 20%">&nbsp;</td>
		<td  style="width: 25%;margin:0px;"><font face="Calibri" size="2">
	    
		{{ Form::text('q', $searchStringArray[1], array('class' => 'auto-style28','style' => 'width: 341px;')) }}</font></td>
		<td class="auto-style45" style="width: 2%"  >&nbsp;
		</td>
		<td class="auto-style59" style="width: 42%" rowspan="32" valign="top">
			@foreach($institutions as $institution)
			<ul style="margin-top: 0; margin-bottom: 0; height:15px;list-style-type:none;margin-left:-2.7em;"><li>
            <small>
			<font face="Calibri" size="3">
            @if(isset($selectedInstitutions) && in_array($institution['id'], $selectedInstitutions))
                {{ Form::checkbox('institution[]', $institution['id'], true, array('class' => 'auto-style53')) }}
            @else
                {{ Form::checkbox('institution[]', $institution['id']) }}
            @endif
               </font></small><font face="Calibri" color="#C0C0C0" size="3"> <a style="text-decoration: none; letter-spacing: 1pt" href="/browse/{{ $institution['id'] }}">
			   <span class="auto-style57">{{ $institution['name'] }}</span></a><span class="auto-style57">&nbsp;</span></font>
			   <span class="auto-style57"><font face="Calibri" size="3">({{$institution['document_count'] }})</font>
			   </span></li></ul>
			@endforeach
			
			 
			<ul style="margin-top: 0; margin-bottom: 0;margin-top: 0; margin-bottom: 0; height:15px;list-style-type:none;margin-left:-2.7em;margin-top:10px; "><li>
			<small>
			<b>
			
			@if($treatyAndCommentaryCollection[0]->document_count>0)
			<span style="letter-spacing: 1pt">
			<font face="Calibri" size="3">
					<input type="checkbox" name="zoom_cat36" value="35" class="auto-style52"></font></span></b><small><font size="4" face="Arial">
					<small><span style="font-family: Corbel; "><font size="3" face="Calibri"><span style="letter-spacing: 1pt"> 
					<span class="auto-style57">
					<a style="text-decoration: none;color:black; letter-spacing: 1pt" href="/browse/{{ $treatyAndCommentaryCollection[0]->id }}"> {{ $treatyAndCommentaryCollection[0]->name }}  ({{ $treatyAndCommentaryCollection[0]->document_count }}) </a>
			</span></span></font></span></small></font>
			</small><span class="auto-style57"><small>
			<font size="4" face="Arial"><small><span style="font-family: Corbel; "><font size="3" face="Calibri"></font></span></small></font></small>
			</span>
			</small></li></ul>
			@endif
			
			@if($treatyAndCommentaryCollection[1]->document_count>0)
					<ul style="margin-top: 0; margin-bottom: 0; height:15px;margin-top: 0; margin-bottom: 0; height:15px;list-style-type:none;margin-left:-2.7em;margin-top:10px;"><li>
					<small>
			<b>
			<span style="letter-spacing: 1pt">
			<font face="Calibri" size="3">
					<input type="checkbox"  name="zoom_cat37" value="35" class="auto-style52"></font></span></b><small><font size="4" face="Arial"><small><span style="font-family: Corbel; "><font size="3" face="Calibri"><span style="letter-spacing: 1pt"> 
					<a style="text-decoration: none;color:black; letter-spacing: 1pt" href="/browse/{{ $treatyAndCommentaryCollection[1]->id }}"> {{ $treatyAndCommentaryCollection[1]->name }}  ({{ $treatyAndCommentaryCollection[0]->document_count }}) </a></span></font></span></small></font></small></small>
					</li></ul>
					
			@endif
			
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 20%; height: 19px"></td>
		<td class="auto-style55" style="height: 19px; width: 25%"><strong> TITLE </strong> 
		</strong></td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style7" style="width: 5%; height: 19px"></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 20%; height: 28px;"></td>
		<td class="auto-style56" style="width: 25%; height: 28px;"><font size="2"><strong>
		{{ Form::text('title', $searchStringArray[2], array('class' => 'auto-style12', 'size' => '46' ,'style' => 'width: 343px')) }}</strong></font></td>
		<td class="auto-style32" style="width: 2%; height: 28px;" valign="top">
		</td>
		<td class="auto-style7" style="width: 5%; height: 28px;"></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 20%; height: 19px"></td>
		<td class="auto-style55" style="height: 19px; width: 25%"><strong>PARTY &middot; VICTIM</strong></td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style7" style="width: 5%; height: 19px"></td>
	</tr>
	<tr>
		<td class="auto-style7" style="width: 20%; height: 28px;"></td>
		<td class="auto-style56" style="width: 25%; height: 28px;"><font size="2"><strong>
		{{ Form::text('parties', $searchStringArray[3], array('class' => 'auto-style12', 'size' => '46' ,'style' => 'width: 343px')) }}</</strong></font></td>
		<td class="auto-style32" style="width: 2%; height: 28px;" valign="top">
		</td>
		<td class="auto-style7" style="width: 5%; height: 28px;"></td>
	</tr>
	<tr>
		<td class="auto-style51" style="width: 20%">&nbsp;</td>
		<td class="auto-style55" style="width: 25%"><strong>CITATION &middot; 
		FILE #</strong></td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style56" style="width: 25%"><font size="2"><strong>
		{{ Form::text('citation', $searchStringArray[4], array('class' => 'auto-style12',  'size' => '46', 'style' => 'width: 343px')) }}</strong></font></td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style9" style="width: 20%"></td>
		<td class="auto-style55" style="width: 25%"><strong>JUDGE &middot; 
		COUNSEL&nbsp;</strong></td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style7" style="width: 5%"></td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style54" style="width: 25%"><font size="2"><strong>
		{{ Form::text('judges', $searchStringArray[5], array('class' => 'auto-style12',  'size' => '46', 'style' => 'width: 343px')) }} </strong></font></td>
		<td class="auto-style45" style="width: 2%" rowspan="2" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style51" style="width: 20%; height: 29px;"></td>
		<td class="auto-style55" style="width: 25%; height: 25px;"><strong>DOCUMENT TYPE</strong></td>
		<td class="auto-style27" style="width: 5%; height: 29px;"></td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style54" style="width: 25%"><font size="2"><strong>
		{{ Form::text('doctype', $searchStringArray[6], array('class' => 'auto-style12',  'size' => '46', 'style' => 'width: 343px')) }}</strong></font></td>
		<td class="auto-style45" style="width: 2%" rowspan="2" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style51" style="width: 20%">&nbsp;</td>
		<td class="auto-style55" style="width: 25%"><strong>TIME PERIOD</strong></td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style54" style="width: 25%">
		<table cellpadding="0" cellspacing="0" style="width: 100%">
			<tr>
				<td class="auto-style25" style="width: 157px"><font size="2">
				<strong>
				{{ Form::text('from', $searchStringArray[7], array('class' => 'auto-style12',  'size' => '46', 'style' => 'width: 158px', 'placeholder' => 'YYYY-MM-DD')) }}</strong></font></td>
				<td class="auto-style21"  ><strong>TO</strong></td>
				<td class="auto-style24"><font size="2"><strong>
				{{ Form::text('to', $searchStringArray[8], array('class' => 'auto-style26',  'size' => '46', 'style' => 'width: 158px', 'placeholder' => 'YYYY-MM-DD')) }}</strong></font></td>
			</tr>
		</table>
		</td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style27" style="width: 25%">&nbsp;</td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style44" style="width: 25%">&nbsp;</td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 20%">&nbsp;</td>
		<td class="auto-style44" style="width: 25%"><strong>
		{{ Form::submit('SEARCH', array('class' => 'auto-style12', 'style' => 'width: 83px; height: 38px')) }}</strong></td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	{{ Form::close() }}

	<tr>
		<td class="auto-style45" style="width: 19%">&nbsp;</td>
		<td class="auto-style27" style="width: 25%">&nbsp;</td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style45" style="width: 19%">&nbsp;</td>
		<td class="auto-style27" style="width: 25%">&nbsp;</td>
		<td class="auto-style45" style="width: 2%" valign="top">&nbsp;
		</td>
		<td class="auto-style27" style="width: 5%">&nbsp;</td>
	</tr>
 
	 
	
	 
	

</body>

</html>
@endsection