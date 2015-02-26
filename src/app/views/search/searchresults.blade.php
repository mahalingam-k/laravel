<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
@extends('layouts.frontend')
@section('content')

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-ca" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Mistminds Search Results</title>
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
	background-color: #504D47;
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
	background-color: #504D47;
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
	font-family:calibri;
	font-size:18px;
	
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
	background-color: #504D47;
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
	background-color: #504D47;
}
.auto-style96 {
	text-decoration: underline;
}
.auto-style102 {
	font-size: medium;
	color: #FFFFFF;
}
#footer{
width:100%;
text-align:center;

}
.auto-style161{
	 
	text-align: left;
	color: #000000;
	font-size: 18px;
	font-family: Calibri;
	background-color: #FFFFFF;
}
 .container{
		margin:0px auto;
		width:100%;
		padding:0px 40px;
		 
		
		
	}
	.searchresults-container{
		float:left;
		width:58%;
		padding-top:15px;
		padding-bottom:5px;
		color: #000000;
		font-size: 18px;
		font-family: Calibri;
		}
	.edit-search-container{
		float:left;
		width:40%;
		text-align:right;
		 
		font-weight: 700;
		color: black;
font-size: 22px;
background-color:#fff;
	}
	.edit-search-container{
		font-size:22px;
		font-weight:bold;
		color:#000;
		font-family: Calibri;
font-size: medium;
background-color:#fff;
		
	}
	.pagination{
		width:100%;
		text-align:center;
		background-color:#504D47;
		height:25px;
		padding-bottom:3px;
			}
	.fixed-header{
		position:fixed;
		width:100%;
		top:50px;
		z-index:10;
		
background-color:#fff;
	}
.col-xs-12 {
width: 100%;
line-height: 17px;
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
	 
	<div class="fixed-header">
	<div class="container"> 
	
	 <div class="searchresults-container">{{ $_SESSION["finalSearchString"] }}</div>
	 <br/>
	 <div class="edit-search-container">
	 &nbsp; <a style="color:black;font-size: large;" href="/search?searchstring={{$_SESSION['searchstring']}}"><strong>edit search</strong></a> &middot; 
							<a id="setalert" style="color:black;font-size: large;" href="#"><strong>set 
							alert</strong></a>
							
							&middot; <a id="emailResult" style="color:black;font-size: large;" href="#"> 
							<strong>email list</strong></a> &middot; <a href="#" style="color:black;font-size: large;" id="downloadResult" >
							<strong>download list</strong></a>
							
				</div>	
	     <div class="pagination"> @include('includes.pagination')
</div>	
 
		
                       
							<table cellpadding="0"  cellspacing="0" style="width:1233px;background-color:#fff; "     >
							
								<tr  >
									<td  style="width: 5%">
									<a href="#" class="highlight-toggle-all"  style="color:#000;"><i class="fa pull-left fa-plus-square"></i></td>
								<!--	<td class="auto-style19" style="width: 33%">
									<strong>TITLE</strong></td>
									<td class="auto-style19" style="width: 33%">
									<strong>DOCUMENT TYPE</strong></td>
									<td class="auto-style19" style="width: 10%">
									<strong>DATABASE</strong></td>
									<td class="auto-style19" style="width: 10%">
									<strong>DATE</strong></td>
									<td class="auto-style19" style="width: 5%">
									<strong>HITS</strong></td> -->
									
										<td class="auto-style20" style="width: 33%"> 
                                        	<center> <strong style="color:#000;"><font color="#000">
                                           <a href="{{ $tableHeader['title']['link'] }}" style="color:#000;text-align:center;">
													{{ $tableHeader['title']['name'] }}
													@if($sortParam == 'title')
													<i class="fa {{ $tableHeader['title']['cssClass'] }}"></i>
													@endif
												</font></a></strong></center> 
                                          </td>
<td class="auto-style15" style="width: 33%">
	<strong style="color:#000;"><font color="#000"><a href="{{ $tableHeader['document_type']['link'] }}" style="color:#000;">
													{{ $tableHeader['document_type']['name'] }}
													@if($sortParam == 'document_type')
													<i class="fa {{ $tableHeader['document_type']['cssClass'] }}"></i>
													@endif
												</font></a></strong>
</td>
<td class="auto-style15" style="width: 10%">
<strong style="color:#000;"><font color="#000"><a href="{{ $tableHeader['institution']['link'] }}" style="color:#000;">
													{{-- $tableHeader['institution']['name'] --}}
													{{ "Database" }}
													@if($sortParam == 'institution')
													<i class="fa {{ $tableHeader['institution']['cssClass'] }}"></i>
													@endif
												</font></a></strong>
</td>
<td class="auto-style15" style="width: 10%">
<strong style="color:#000;"><font color="#000"><a href="{{ $tableHeader['date']['link'] }}" style="color:#000;">
													{{ $tableHeader['date']['name'] }}
													@if($sortParam == 'date')
													<i class="fa {{ $tableHeader['date']['cssClass'] }}"></i>
													@endif
												</font></a></strong>
</td>
                                     <!--   @foreach ($tableHeader as $key => $headerColumn)
											<td class="auto-style19"   >
												<strong style="color:#000;"><font color="#000"><a href="{{ $headerColumn['link'] }}" style="color:#000;">
													{{ $headerColumn['name'] }}
													@if($sortParam == $key)
													<i class="fa {{ $headerColumn['cssClass'] }}"></i>
													@endif
												</font></a></strong>
											</td>
										@endforeach -->
										
										<td class="auto-style19" style="width: 5%">
									<strong>Hits</strong></td>
								</tr> 
                                </table>
								</div>
								</div>
								<div class="container">
								 <table cellpadding="0" cellspacing="0" style="width:1233px;margin-top:127px;margin-left:-4px;z-index:1; >
						<tr>
							<td class="auto-style18" style="width: 5%">&nbsp;</td>
							<td class="auto-style18" style="width: 5%">&nbsp;</td>
							<td class="auto-style161" colspan="2">
                                <table cellpadding="0" cellspacing="0" style="width: 1233px"    >
								<!--<tr>
									<td  style="width: 5%">
									<strong><a href="#" class="highlight-toggle-all" ><i>+</i></strong></td>
									
								@foreach ($tableHeader as $key => $headerColumn)
									<th class="{{ $sortParam }}">
										<a href="{{ $headerColumn['link'] }}">
											{{ $headerColumn['name'] }}
											@if($sortParam == $key)
											<i class="fa {{ $headerColumn['cssClass'] }}"></i>
											@endif
										</a>
									</th>
								@endforeach
									<th>Hits</th>
								</tr> -->
								
								 
								<!-- <tr>
									<th><a href="#" class="highlight-toggle-all"><i class="fa pull-right fa-plus-square"></i></th>
									<th>#</th>
								@foreach ($tableHeader as $key => $headerColumn)
									<th class="{{ $sortParam }}">
										<a href="{{ $headerColumn['link'] }}">
											{{ $headerColumn['name'] }}
											@if($sortParam == $key)
											<i class="fa {{ $headerColumn['cssClass'] }}"></i>
											@endif
										</a>
									</th>
								@endforeach
									<th>Hits</th>
								</tr> -->
								 
								
								@foreach ($resultset as $index => $document)
								@if(count($highlights[$document->id]['body']))
								<tr bgcolor="#f3f3f3">
								@else
								<tr >
								@endif
									<td style="width: 5%"><a href="#" class="highlight-toggle" rel-data="document-{{ $document->id }}">
									@if(count($highlights[$document->id]['body']))								
									<strong style="color:#000;">+</strong>
									@endif
									</td>
									<td class="auto-style20" style="width: 33%">  
										<a href="document/{{$document->id}}/{{$ids}}/{{$hits}}" style="color:#000;"></a>
										@if(isset($highlights[$document->id]['search_title'][0]))
										<a href="/document/{{$document->id}}?dctype={{ $document->type }}&ids={{$ids}}&hits=0" style="color:#000;">{{ $highlights[$document->id]['search_title'][0] }}</a>
										@else
										<a href="/document/{{$document->id}}?dctype={{ $document->type }}&ids={{$ids}}&hits=0" style="color:#000;">{{ $document->search_title }}</a>
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
									<td class="auto-style15" style="width: 10%">{{ date('d-M-Y',strtotime(Document::convertDateFromSolrFormat($document->date, Document::DATE_FORMAT_NICE))) }}
									
									</td>
									<td class="auto-style15" style="width: 5%">
									@if($document->hits != 0)
									{{ $document->hits }}</td>
									@else
										1
									@endif
								</tr>
								<tr class="highlight-body info document-{{ $document->id }}" style="z-index:4;">
									<td colspan="7">
									@foreach($highlights[$document->id]['body'] as $snippet)
										<div class="form-group col-xs-12">...{{ $snippet }}...</div>
									@endforeach
									</td>
								</tr>
								@endforeach														
							</table>
							<input type="hidden" id="isAuth" value="{{Auth::check()}}"/>
							
							</td>
							<td class="auto-style18" style="width: 5%">&nbsp;</td>
						</tr>
					</table>
					</div>
                    
					</td>
				</tr>
			

<script type="text/javascript">
var alertflag = 0;
function create( template, vars, opts ){
	return $container.notify("create", template, vars, opts);
}

		$(document).ready(function(){
		
			$('#modal-emaillist').modal({
                show: false
            });
				//	alert('doc ready');
				alertflag = '{{$_SESSION["alertFlag"]}}';
				
		});
						
		$("#setalert").click(function(e) 
		{
			e.preventDefault();
			if($("#isAuth").val())
			{
				//alert('User is authenticated');
				//alertflag = '{{$_SESSION["alertFlag"]}}';
				
				if(alertflag == 1)
				{
					$container = $("#container").notify();
				create("default", { title:'Set Alert', text:'Alert has been already set.'});
					
					/*var b = '{{ $_SESSION["finalSearchString"] }}';
					var n = b.indexOf("for");
					var srchstr = b.substring(n);
					var fs = 'Alert for '+srchstr+' has been set. You will receive emails with new documents for this search string. Delete the alert by following a link in any alert-related email.';
				//	var nw=fs.replace(/"/g, '\\"');
				
					$container = $("#container").notify();
				create("default", { title:'Set Alert', 
		text:fs}); */
				}
				else
				{
					$.ajax(
					{
				
						type: "GET",
						
						cache: false,
						
						url: '/setAlert?searchTermId={{$_SESSION["searchTermId"]}}',
											
						success: successSetAlert,
						
						error: errorAlert
				
					});
				}				
			}
			else
			{
				//alert('not logged in');
				$container = $("#container").notify();
				create("default", { title:'Set Alert', text:'Please Sign In to use this function. Registration is free and takes less than a minute.'});
				//alert('Please sign in or sign up to access this feature');
			}
		
		});
		function successSetAlert()
		{
			alertflag = 1;
			
			//alert('success!');
			var b = '{{ $_SESSION["finalSearchString"] }}';
					var n = b.indexOf("for");
					var srchstr = b.substring(n);
					var fs = 'Alert '+srchstr+' has been set. You will receive emails with new documents for this search string. Delete the alert by following a link in any alert-related email.';
				//	var nw=fs.replace(/"/g, '\\"');
				
					$container = $("#container").notify();
				create("default", { title:'Set Alert', 
		text:fs});
		
		//	document.getElementById('setalert').style.display='none';
		//	document.getElementById('alertset').style.display='';
		}
		$("#emailResult").click(function() 
		{
		
			//alert($("#isAuth").val());
			if($("#isAuth").val())
			{
				
				$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					url: "/delivery/emailresults/{{ $ids }}/{{ $hits }}",
										
					success: successmsg,
					
					error: errorAlert
			
				});
			}
			else
			{
				$container = $("#container").notify();
				create("default", { title:'Email List', text:'Please Sign In to use this function. Registration is free and takes less than a minute.'});
				//alert('Please sign in or sign up to access this feature');
			}
			
			
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
			create("default", { title:'', text:'<center><font color="red">List Emailed.</font></center>'});
		}
		 
		$("#downloadResult").click(function() 
		{
			//alert('hi');
			if($("#isAuth").val())
			{
				//alert('User is authenticated');
				$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					url: "/delivery/savedownloadstatsforuser/{{ $ids }}/{{ $hits }}",
										
					success: successdownloadstat,
					
					error: errorAlert
			
				});
				//window.location.href = '/delivery/downloadresults/{{ $ids }}/{{ $hits }}'; 
			}
			else
			{
				$container = $("#container").notify();
				create("default", { title:'Download list', text:'Please sign in to use this function.'});
				//alert('Please sign in or sign up to access this feature');
			}
			
			function successdownloadstat()
			{
				//alert('download stat success!');
				window.location.href = '/delivery/downloadresults/{{ $ids }}/{{ $hits }}'; 
			}
		
		});
		
	</script>
	</body>
</html>
@endsection