<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
@extends('layouts.frontend')
@section('content')

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-ca" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>{{ $valuesArray['docPropertiesArray'][2] }}</title>
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
	text-align: left;
	background-color: #666666;
}
.auto-style161 {
	text-align: left;
	color: #000000;
	font-size: 18px;
	font-family: Calibri;
	background-color: #FFFFFF;
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
	width:100%;
	  
	font-family:calibri;
	font-size: larze;
	text-align: right;
	float:right;
	background-color: #FFFFFF;
	text-align: -webkit-right;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	letter-spacing: normal;
	line-height: normal;
	text-indent: 0px;
	text-transform: none;
	white-space: normal;
	word-spacing: 0px;
	display: inline;
	clear:left;
	
}
 

.auto-style57 {
	color: #000000;
	text-align: center;
	 
	font-weight:large;
	 font-size:15px;
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

.auto-style73 {
	text-align: -webkit-right;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	letter-spacing: normal;
	line-height: normal;
	text-indent: 0px;
	text-transform: none;
	white-space: normal;
	word-spacing: 0px;
	display: inline;
}

.auto-style64 {
	text-align: center;
	font-weight: bold;
}
.auto-style61 {
	text-align: center;
	font-family: Calibri;
	text-transform:uppercase;
}
.auto-style67 {
	text-align: center;
	color: #808080;
}
.auto-style75 {
	text-align: left;
}
.auto-style70 {
	text-align: center;
	font-family: Calibri;
	color: rgb(0, 0, 0);
	font-size: medium;
}
.auto-style65 {
	text-align: center;
	font-family: Calibri;
	color: #808080;
	font-size: medium;
}
.auto-style62 {
	text-align: center;
	font-family: Calibri;
	color: rgb(0, 0, 0);
}
.auto-style60 {
	text-align: center;
	text-decoration: none;
}
.auto-style63 {
	color: rgb(0, 0, 0);
	font-family: Calibri;
}
.auto-style76 {
	font-size: medium;
}
.auto-style77 {
	color: #FFFFFF;
	background-color: #504D47;
}
.auto-style78 {
	text-align: left;
	background-color: #504D47;
}
.auto-style79 {
	color: #FFFFFF;
	text-align: center;
	background-color: #504D47;
}
.auto-style80 {
	font-size: small;
}
.auto-style81 {
	margin-top: 0;
	margin-bottom: 0;
}
.auto-style82 {
	text-align: center;
	margin-top: 0;
	margin-bottom: 0;
}
.auto-style83 {
	font-weight: bold;
	margin-top: 0;
	margin-bottom: 0;
}
.auto-style84 {
	line-height: 100%;
	margin-top: 0;
	margin-bottom: 0;
	
}
.auto-style85 {
	background-color: #f3f3f3;
}
.auto-style86 {
	text-align: center;
	color: rgb(0, 0, 0);
	font-size: medium;
	text-transform: uppercase;
	letter-spacing: normal;
}
.auto-style87 {
	text-align: center;
	color: rgb(0, 0, 0);
	text-transform: uppercase;
	font-style: normal;
	font-variant: normal;
	letter-spacing: normal;
	line-height: normal;
	text-indent: 0px;
	white-space: normal;
	word-spacing: 0px;
	font-size: medium;
	margin-left: 0in;
	margin-right: 0in;
	margin-top: 0in;
	margin-bottom: 0.0001pt;
}
.auto-style88 {
	text-align: center;
	font-family: Calibri;
	font-variant: small-caps;
}
.auto-style89 {
	text-align: left;
	text-decoration: underline;
}
.auto-style91 {
	font-size: medium;
}
.auto-style97 {
	font-family: Calibri;
	font-size: medium;
	background-color: #504D47;
}
.auto-style98 {
	text-align: right;
	font-family: Calibri;
	font-size: medium;
	background-color: #504D47;
}

</style>
</head>

<body style="margin: 0">
 
<div id="container" style="display:none">
		<div id="default">
			<h1>#{title}</h1>
			<p>#{text}</p>
		</div>
	</div>	
<table cellpadding="0" cellspacing="0" style="width: 100%;  " border="0">
	@if($valuesArray['showdocument'] == 1)
	<tr>
		<td class="auto-style15" colspan="5" border="0" valign="top">
		<table style="width: 100%;position:fixed; ">
			<tr>
				<td>
				<table cellpadding="0" cellspacing="0" style="width: 100%; background-color:#fff;"  >
					 
					<tr>
						<td class="auto-style18" style="width: 5%; height:60px;">&nbsp;</td>
						<td class="auto-style161" style="width:60%;">
						@if($valuesArray['noteup']=='false' && isset($_SESSION["finalSearchString"]))
						{{ $_SESSION["finalSearchString"] }}
						@elseif(isset($_SESSION["noteupSearchString"]))
						{{ $_SESSION["noteupSearchString"] }}
						@else
						
						@endif
						</td>
						<td class="auto-style17"  >&nbsp; 
							@if($_SESSION["search_page"] == 'true')	
							<a style="color:black;font-size: large;" href="/search?searchstring={{$_SESSION['searchstring']}}">
								<strong>edit search</strong>
							</a> &middot; 
							<a id="setalert" style="color:black;font-size: large;" href="#">
								<strong>set alert</strong>
							</a> &middot; 
							@endif
							<a id="emailDocument" href="#" style="color:black;font-size: large;" >
								<strong>email</strong>
							</a> &middot; 
							<a id="downloadDocument" href="#" style="color:black;font-size: large;" >
								<strong>download</strong>
							</a>&middot; 
							<a id="noteup" href="/noteup?alertFlag={{$valuesArray['alertFlag']}}&searchTermId={{$valuesArray['searchTermId']}}&docid={{$valuesArray['id']}}&searchString={{$_SESSION['searchstring']}}&st={{$valuesArray['st']}}&prevDoc={{$valuesArray['prevDoc']}}&nextDoc={{$valuesArray['nextDoc']}}&hits={{$valuesArray['hits']}}&maxhit={{$valuesArray['maxhit']}}&ids={{$valuesArray['ids']}}" style="color:black;font-size: large;" ><strong>note up</strong></a> 
						<input type="hidden" id="isAuth" value="{{Auth::check()}}"/></td>
						<td class="auto-style18" style="width: 5%">&nbsp;</td>
					</tr>
					 
					<tr>
						<td class="auto-style97" style="width: 5%; background-color:#fff;">&nbsp;</td>
						<td class="auto-style98" colspan="2">
						<table cellpadding="0" cellspacing="0" style="width: 100%">
							<tr>
								<td class="auto-style78" style="width: 339px"><!--<font color="#000000" face="Calibri" size="2">
            <select size="1" name="D1" style="font-family: Calibri; " class="auto-style76">
        <option>Heading 1</option>
        <option>&nbsp;&nbsp; Heading 2</option>
        <option>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Heading 3</option>
              <option>123456789012345678901234567890</option>
            </select></font>-->&nbsp;</td>
								<td class="auto-style79" style="width: 587px">
								@if($_SESSION["search_page"] == 'true')
								<a id="previousHit" href="#" style="color:white;font-size: large;" ><strong>previous hit</strong></a> · 
				<span class="auto-style91">
				@endif
				@if($valuesArray['prevDoc']!=0)
					<a id="prevDocument" @if($_SESSION["search_page"] == 'false') style="color:white;margin-left:35px;align:left;font-size: large;" @else style="color:white;align:left;font-size: large;" @endif href="/document/{{$valuesArray['prevDoc']}}?ids={{$valuesArray['ids']}}&hits={{$valuesArray['hits']}}&q={{$valuesArray['st']}}"><strong>previous document</strong></a> &middot;
				@else
					<a id="prevDocument" @if($_SESSION["search_page"] == 'false') style="color:#C0C0C0;margin-left:35px;align:left;font-size: large;" @else style="color:white;align:left;font-size: large;" @endif href="#"><strong>previous document</strong></a> &middot;
				@endif
				@if($valuesArray['nextDoc']!=0)
					<a id="nextDocument" style="color:white;font-size: large;" href="/document/{{$valuesArray['nextDoc']}}?ids={{$valuesArray['ids']}}&hits={{$valuesArray['hits']}}&q={{$valuesArray['st']}}"><strong>next document</strong></a>
				@else
					<a id="nextDocument" style="color:#C0C0C0;font-size: large;" ><strong>next document</strong></a>
				@endif
				</span> 
					@if($_SESSION["search_page"] == 'true')
						&middot; 	
						<a id="nextHit" href="#" style="color:white;font-size: large;"><strong>next&nbsp; hit</strong></a></td>
					@endif	
								<td class="auto-style77" style="width: 397px">&nbsp;</td>
							</tr>
						</table>
						</td>
						<td class="auto-style97" style="width: 5%;background-color:#fff;">&nbsp;</td>
					</tr></table>
					</table>
					<table cellpadding="0" cellspacing="0" style="width: 100%">
					<table cellpadding="0" cellspacing="0" style="width: 100%">
					
					 
					<tr height="100px">
						<td class="auto-style18" style="width: 5%">&nbsp;</td>
						<td  colspan="2">&nbsp;
						</td>
						<td class="auto-style18" style="width: 5%">&nbsp;</td>
					</tr>
					@if($valuesArray['noteup']!='false')
					<tr>
							<td class="auto-style18" style="width: 5%">&nbsp;</td>
							<td class="auto-style161" colspan="2">
							<table cellpadding="0" cellspacing="0" style="width: 100%;top:150px; z-index:-10;">
							
								<tr>
									<td  style="width: 5%">
									<strong><a href="#" class="highlight-toggle-all" style="color:#000;" ><i class="fa pull-left fa-plus-square"></i></strong></td>
									<td class="auto-style19" style="width: 33%">
									<strong>TITLE</strong></td>
									<td class="auto-style19" style="width: 33%">
									<strong>DOCUMENT TYPE</strong></td>
									<td class="auto-style19" style="width: 10%">
									<strong>DATABASE</strong></td>
									<td class="auto-style19" style="width: 10%">
									<strong>DATE</strong></td>
									<td class="auto-style19" style="width: 5%">
									<strong>HITS</strong></td>
								</tr> 
																
								<tr>
									<td class="auto-style15" style="width: 5%">&nbsp;</td>
									<td class="auto-style20" style="width: 33%">&nbsp;</td>
									<td class="auto-style15" style="width: 33%">&nbsp;</td>
									<td class="auto-style15" style="width: 10%">&nbsp;</td>
									<td class="auto-style15" style="width: 10%">&nbsp;</td>
									<td class="auto-style15" style="width: 5%">&nbsp;</td>
								</tr>
								
								@foreach ($valuesArray['resultset'] as $index => $document)
								<tr>
									<td style="width: 5%"><a href="#" class="highlight-toggle" style="color:#000;" rel-data="document-{{ $document->id }}">
									@if(count($valuesArray['hightlight_array'])>0)
									<strong>+</strong>
									@endif
									</td>
									<td class="auto-style20" style="width: 33%">
										<a href="document/{{$document->id}}/{{$valuesArray['ids']}}/{{$valuesArray['hitsForSearchResults']}}"></a>
										@if(isset($valuesArray['highlights'][$document->id]['title'][0]))
										<a href="document/{{$document->id}}?dccnt={{$valuesArray['resultset']->getNumFound()}}&searchString={{$valuesArray['searchString']}}&dctype={{ $document->type }}&q={{ $valuesArray['q'] }}&ids={{$valuesArray['ids']}}&hits=0">{{ $valuesArray['highlights'][$document->id]['title'][0] }}</a>
										@else
										<a href="document/{{$document->id}}?dccnt={{$valuesArray['resultset']->getNumFound()}}&searchString={{$valuesArray['searchString']}}&dctype={{ $document->type }}&q={{ $valuesArray['q'] }}&ids={{$valuesArray['ids']}}&hits=0">{{ $document->search_title }}</a>
										@endif
									</td>
									<td class="auto-style15" style="width: 33%">{{ $document->document_type }}</td>
									<td class="auto-style15" style="width: 10%">
									@if($document->institution)
										@if(isset($highlights[$document->id]['institution'][0]))
											{{ $_SESSION["institutionArray"][$document->institution]}} 
										@else
											{{ $_SESSION["institutionArray"][$document->institution] }}
										@endif
									@elseif($document->type == 'treaty')
										Treaties
									@elseif($document->type == 'commentary')
										Commentaries
									@endif
									</td>
									<td class="auto-style15" style="width: 10%">{{ Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE) }}</td>
									<td class="auto-style15" style="width: 5%">{{ $document->hits }}</td>
								</tr>
								<tr class="highlight-body info document-{{ $document->id }}">
									<td colspan="7" class="auto-style15">
									@foreach($valuesArray['hightlight_array'] as $highligt)
										@if($highligt['doc_id'] == $document->id)
										<div class="form-group col-xs-12">...{{ $highligt['body'] }}...</div>
										@endif
									@endforeach
									</td>
								</tr>
								@endforeach														
							</table>
							<input type="hidden" id="isAuth" value="{{Auth::check()}}"/>
							</td>
							<td class="auto-style18" style="width: 5%">&nbsp;</td>
						</tr>
					@endif
					
					@if($valuesArray['noteup']=='false')
                    <tr><td>&nbsp;</td></tr>
					<tr>
						<td class="auto-style18" style="width: 5%">&nbsp;</td>
						<td colspan="2" align="left">
			
				<div class="auto-style56">
<p class="auto-style73" style="orphans: auto; widows: auto; -webkit-text-stroke-width: 0px;  "><font face="calibri"style="font-size:medium;">
{{ $valuesArray['docPropertiesArray'][9] }}<br/><br>{{ $valuesArray['docPropertiesArray'][3]}}<br></font></p>
				</div>
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" style="font-family:calibri;font-size:medium;" lang="EN-US">
				@if(count($valuesArray['highlight'][$valuesArray['id']]['institution']) > 0)
				{{ $valuesArray['highlight'][$valuesArray['id']]['institution'][0] }}
				@else
				{{ $_SESSION["document"]->institution }}
				@endif</span></b></p>
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US">{{ $_SESSION["document"]->institution_subdivision }}</span></b></p> 
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US">&nbsp;</span></b></p>
				<div style="font-family: Calibri;font-size: medium;">
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US"><strong>
				@if(count($valuesArray['highlight'][$valuesArray['id']]['title']) > 0)
				{{ $valuesArray['highlight'][$valuesArray['id']]['title'][0] }}
				@else
				{{ $_SESSION["document"]->title }}
				@endif</strong></span></b></p>
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US"><strong>{{ $_SESSION["document"]->title_short }}</strong></span></b></p><br/>
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US"><strong>{{ $_SESSION["document"]->applicant }}</strong></span></b></p>
				<p class="auto-style82">
				@if($_SESSION["document"]->type == 'decision')
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US"><strong>v.</strong></span></b></p>
				@endif
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US"><strong>{{ $_SESSION["document"]->respondent }}</strong></span></b></p><br/>
				@if(strlen($_SESSION["document"]->author) > 0)
				<p class="auto-style82">
				<b style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: -webkit-center; text-indent: 0px; text-transform: uppercase; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style57" lang="EN-US"><strong>{{ $_SESSION["document"]->author }}</strong></span></b></p><br/>
				@endif
				<p align="center" class="auto-style83" style="color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
				<span class="auto-style61" style="font-family:calibri;font-size:medium;"lang="EN-US">  {{ $valuesArray['docPropertiesArray'][11] }}   </span><span lang="EN-US"><o:p></o:p></span></p>
				<p style="color: rgb(0, 0, 0); font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;" class="auto-style81">
				<span class="auto-style15" lang="EN-US"><o:p>&nbsp;</o:p></span></p>
				</div>
				
				<table border="0" cellpadding="0" cellspacing="0" class="auto-style18" style="border-collapse: collapse; line-height: 16.8666667938232px; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px;">
					
					@if($valuesArray['docPropertiesArray'][4]=='treaty' )
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">In Force From:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						
						<p class="auto-style84"><span lang="EN-US">{{ Document::convertDateFromSolrFormat($_SESSION["document"]->in_force_from, Document::DATE_FORMAT_NICE) }}<o:p></o:p></span></p>
						</td>
					</tr>
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">In Force Until:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						
						<p class="auto-style84"><span lang="EN-US">{{ Document::convertDateFromSolrFormat($_SESSION["document"]->in_force_until, Document::DATE_FORMAT_NICE) }}<o:p></o:p></span></p>
						</td>
					</tr>
					@endif
					@if($valuesArray['docPropertiesArray'][4] == 'commentary')
						@if($_SESSION["document"]->purchase_link != '')	
							<tr>
								<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
								<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Purchase:<o:p></o:p></span></p>
								</td>
								<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
								
								<p class="auto-style84"><span lang="EN-US">{{ $_SESSION["document"]->purchase_link }}<o:p></o:p></span></p>
								</td>
							</tr>
						@endif
						@if($_SESSION["document"]->borrow_link != '')
							<tr>
								<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
								<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Borrow:<o:p></o:p></span></p>
								</td>
								<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
								
								<p class="auto-style84"><span lang="EN-US">{{ $_SESSION["document"]->borrow_link }}<o:p></o:p></span></p>
								</td>
							</tr>
						@endif
						@if($_SESSION["document"]->view_link != '')
							<tr>
								<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
								<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">View:<o:p></o:p></span></p>
								</td>
								<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
								
								<p class="auto-style84"><span lang="EN-US">{{ $_SESSION["document"]->view_link }}<o:p></o:p></span></p>
								</td>
							</tr>
						@endif
					@endif
					@if($valuesArray['docPropertiesArray'][4] == 'decision' && $valuesArray['docPropertiesArray'][5]!='')
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Decided by:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						
						<p class="auto-style84"><span lang="EN-US">{{ $valuesArray['docPropertiesArray'][5] }}<o:p></o:p></span></p>
						</td>
					</tr>
					@endif
					@if($valuesArray['docPropertiesArray'][4] == 'decision' && $valuesArray['docPropertiesArray'][6]!='')
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Represented by:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						
						<p class="auto-style84">{{ $valuesArray['docPropertiesArray'][6] }}</p>
						</td>
					</tr>
					@endif
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Citation:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						<p class="auto-style84"><span lang="EN-US">{{ $valuesArray['docPropertiesArray'][2] }} </span></p>
						</td>
					</tr>
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">PermaLink:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						<p class="auto-style84" >
						<o:p><a href="{{ $valuesArray['permalink'] }}">{{ $valuesArray['permalink'] }}</a></o:p></p>
						</td>
					</tr>
					@if( strlen($_SESSION["document"]->publication) > 0)
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Publication:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						<p class="auto-style84">{{ $valuesArray['docPropertiesArray'][8]}}</p>
						</td>
					</tr>
					@endif
					@if($_SESSION["document"]->tags[0] !='')
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Tags:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						@foreach($_SESSION["document"]->tags as $tags)
						<p class="auto-style84">{{ $tags }}</p>
						@endforeach
						</td>
					</tr>
					@endif
					@if($valuesArray['docPropertiesArray'][7] != '')
					<tr>
						<td style="width: 120pt; padding: 0in 5.4pt;" valign="top" class="auto-style85">
						<p class="auto-style84" style="background-color: #f3f3f3;"><span lang="EN-US">Editor’s Note:<o:p></o:p></span></p>
						</td>
						<td style="width: 788pt; padding: 0in 5.4pt;" valign="top">
						<p class="auto-style84"> [ {{ $valuesArray['docPropertiesArray'][7] }}]</p>
						</td>
					</tr>
					@endif
				</table>	
				<div style="font-family: Calibri;font-size: medium;">
				 {{ $valuesArray['linkBody'] }}
				<div>		
				       @if($valuesArray['docPropertiesArray'][4]=='treaty' )
				 <p class="auto-style113" style="text-align:center;text-indent: 0px; color: rgb(0, 0, 0); font-variant: normal; line-height: normal; orphans: auto; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; margin-right: 0in; margin-top: 0in; margin-bottom: 0.0001pt;">
						<strong><br/>DECLARATIONS, RESERVATIONS &amp; UNDERSTANDINGS</strong></p><br/>
						<table cellpadding="0" cellspacing="0" style="width: 100%" border="1">
						@if(count($_SESSION["declarationsValues"]) > 0)
							@for($j=0;$j<$_SESSION["declarations_count"];$j++)
							<tr>
								<td class="auto-style114" style="width: 177px">
								{{ $_SESSION["declarationsValues"][$j][0] }}</td>
								<td class="auto-style114">{{ $_SESSION["declarationsValues"][$j][1] }}</td>
							</tr>	
							@endfor
							@else	
							<tr>	
								<td class="auto-style114" style="width: 177px">
								&nbsp;</td>
								<td class="auto-style114">&nbsp;</td>
							</tr>
							@endif							
						</table>
						<br />
						<p class="auto-style113" style="text-align:center;text-indent: 0px; color: rgb(0, 0, 0); font-variant: normal; line-height: normal; orphans: auto; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; margin-right: 0in; margin-top: 0in; margin-bottom: 0.0001pt;">
						<strong>RATIFICATIONS &amp; SIGNATURES</strong></p>
						<br />
						<table border="1" cellpadding="0" cellspacing="0" class="auto-style115" style="width: 100%">
							<tr align="center">
								<td class="auto-style116" style="width: 297px">
								<strong>State</strong></td>
								<td class="auto-style116" style="width: 297px">
								<strong>Signed</strong></td>
								<td class="auto-style116" style="width: 297px">
								<strong>Ratified/Accessed</strong></td>
								<td class="auto-style116" style="width: 298px">
								<strong>Deposited</strong></td>
							</tr>
							@if(count($_SESSION["ratifications_signatures"]) > 0)
								@for($i=0;$i<$_SESSION["ratifications_count"];$i++)
							<tr> 
								<td class="auto-style116" style="width: 297px">
								<center>{{ $_SESSION["ratifications_signatures"][$i][0] }}</center></td>								<td class="auto-style116" style="width: 297px">
								<center>{{ $_SESSION["ratifications_signatures"][$i][1] }}</center></td>
								<td class="auto-style116" style="width: 297px">
								<center>{{ $_SESSION["ratifications_signatures"][$i][2] }}</center></td>
								<td class="auto-style116" style="width: 298px">
								<center>{{ $_SESSION["ratifications_signatures"][$i][3] }}</center></td>
							<tr>	
							@endfor		
								@else
							<tr>	
								<td class="auto-style116" style="width: 297px">
								<center>&nbsp;</center></td>
								<td class="auto-style116" style="width: 297px">
								<center>&nbsp;</center></td>
								<td class="auto-style116" style="width: 297px">
								<center>&nbsp;</center></td>
								<td class="auto-style116" style="width: 298px">
								<center>&nbsp;</center></td>
							</tr>	
							@endif
							<!-- <tr>
								<td class="auto-style116" style="width: 297px">&nbsp;</td>
								<td class="auto-style114" style="width: 297px">&nbsp;</td>
								<td class="auto-style114" style="width: 297px">&nbsp;</td>
								<td class="auto-style114" style="width: 298px">&nbsp;</td>
							</tr> -->
						</table>
						<br />
						@endif
				</td>
						<td class="auto-style18" style="width: 5%">&nbsp;</td>
					</tr>
					@endif
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>

</table>
{{ Form::open(array('url' => 'foo/bar')) }}
   {{ Form::hidden('nm', $valuesArray['name'], array('id' => 'nam')) }}
   {{ Form::hidden('previous', 0, array('id' => 'previous')) }}
   {{ Form::hidden('next', 1, array('id' => 'next')) }}
   {{ Form::hidden('current', 0, array('id' => 'current')) }}
{{ Form::close() }}
 @endif
</body>
<script type="text/javascript">
var alertflag = 0;
        function create( template, vars, opts ){
	return $container.notify("create", template, vars, opts);
}
		$(document).ready(function(){
	//	alert('hi');
		var sd = "{{ $valuesArray['showdocument'] }}";
		if(sd == 0)
		{
			alert('Document Not Found');
		}
		else
		{
			alertflag = "{{ $valuesArray['alertFlag'] }}";
			
			document.getElementById('previousHit').style.color='#C0C0C0';
		}
		
	
 
		$('#main-container').tocible({ 
navigation:'#tocible', 
heading:'h2', 
subheading:'h3', 
title:'contents'
});
		
		var name=$("#nam").val();
		var target = ".".concat(name);
	  // alert($('#para7').html());
	   //$('.para7').focus();
	  // $(''+target+'').focus();
	 /* $('html, body').animate({
                        scrollTop: $(''+target+'').offset().top
                    }, 500);
			  
        }); */
		if(!name.length){
				return;
			}
	 $('html, body').animate({
		                    scrollTop: $(""+name+"").offset().top-138}, 500);
			  
        });
		
		$("#emailDocument").click(function() 
		{
			
			if($("#isAuth").val())
			{
				//alert('User is authenticated');
				$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					url: "/delivery/emaildocument/{{ $valuesArray['id'] }}",
	
					success: successmsg,
					
					error: errorAlert
			
				});
			}
			else
			{
				$container = $("#container").notify();
				create("default", { title:'Email Document', text:'Please Sign In to use this function. Registration is free and takes less than a minute.'});
				//alert('Please sign in or sign up to access this feature');
			}
			
		});
		
		$("#setalert").click(function() 
		{
			var stid = "{{$valuesArray['searchTermId']}}";
			//alert(stid);
			if($("#isAuth").val())
			{
				
				if(alertflag == 1)
				{
					$container = $("#container").notify();
				create("default", { title:'Set Alert', text:'Alert has been already set.'});
					
				}
				else
				{
					$.ajax(
					{
				
						type: "GET",
						
						cache: false,
						
						url: "/setAlert?searchTermId="+stid,
											
						success: successSetAlert,
						
						error: errorAlert
				
					});
				}
			}
			else
			{
				$container = $("#container").notify();
				create("default", { title:'Set Alert', text:'Please Sign In to use this function. Registration is free and takes less than a minute.'});
				//alert('Please sign in or sign up to access this feature');
			}
		
		});
		function successSetAlert()
		{
			alertflag = 1;
			/*alert('success!');
			document.getElementById('setalert').style.display='none';
			document.getElementById('alertset').style.display=''; */
			var b = '{{ $_SESSION["finalSearchString"] }}';
			var n = b.indexOf("for");
			var srchstr = b.substring(n);
			var fs = 'Alert '+srchstr+' has been set. You will receive emails with new documents for this search string. Delete the alert by following a link in any alert-related email.';
				
			$container = $("#container").notify();
				create("default", { title:'Set Alert', 
		text:fs});
				
		}
		
		$("#downloadDocument").click(function() 
		{
			
			if($("#isAuth").val())
			{
				//alert('User is authenticated');
				$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					url: "/delivery/savedownloadstatsfordocument/{{ $valuesArray['id'] }}",
										
					success: successdownloadstat,
					
					error: errorAlert
			
				});
				//window.location.href = "/delivery/downloaddocument/{{ $valuesArray['id'] }}"; 
				
			}
			else
			{
				$container = $("#container").notify();
				create("default", { title:'Document Download', text:'Please Sign In to use this function. Registration is free and takes less than a minute.'});
				//alert('Please sign in or sign up to access this feature');
			}
				
			function successdownloadstat()
			{
				//alert('download stat success!');
				window.location.href = "/delivery/downloaddocument/{{ $valuesArray['id'] }}"; 
			}
		});
		
		function errorAlert(e, jqxhr)
		{
		
		alert("Your request was not successful: " + jqxhr);
		
		}
		
		function successmsg()
		{
			//alert('success!');
			$container = $("#container").notify();
			create("default", { title:'', text:'<center><font color="red">Document Emailed.</font></center>'});
		}
		
		$("#nextHit").click(function() 
		{
			//var prev=parseInt($("#previous").val());
			//var next=parseInt($("#next").val());
			var current=parseInt($("#current").val());
			
			//document.getElementById('previousHit').style.display='';
			document.getElementById('previousHit').style.color='white';
			var mhit = parseInt("{{ $valuesArray['maxhit']}}");
			//alert(mhit);
			var maxhit = (mhit - 2);
			//alert(maxhit);
			if(current == maxhit)
			{
				//document.getElementById('nextHit').style.display='none';
				document.getElementById('nextHit').style.color='#C0C0C0';
			}
			
			var nextval = current + 1;
			//var prevVal = prev + 1;
			var hglt = 'highlight'+nextval;
			if(!hglt.length){
				return;
			}	
			var offset = $('.'+hglt+'').offset().top;
			$('html, body').animate({
                        scrollTop: offset-138
                    }, 500);
			
			$('input:hidden[name="current"]').val(nextval);
			// $('input:hidden[name="next"]').val(nextval);
			// $('input:hidden[name="previous"]').val(prevVal);

		});
		
		$("#previousHit").click(function() 
		{
			//var prev=parseInt($("#previous").val());
			//var next=parseInt($("#next").val());
			document.getElementById('nextHit').style.color='white';
			var current=parseInt($("#current").val());
			document.getElementById('nextHit').style.display='';
			//alert(prev);
			if(current<2)
			{
				
			//	document.getElementById('previousHit').style.display='none';
				document.getElementById('previousHit').style.color='#C0C0C0';
			}
			else
			{
				
			}
			
			var prevVal = current - 1;
			var hglt = 'highlight'+prevVal;
			var offset = $('.'+hglt+'').offset().top
			if(!hglt.length){
				return;
			}
			$('html, body').animate({
                        scrollTop: offset-138
                    }, 500);
			// $('input:hidden[name="next"]').val(nextval);
			// $('input:hidden[name="previous"]').val(prevVal);
			$('input:hidden[name="current"]').val(prevVal);
		});
		
		
	     
    </script>


</html>
@endsection