
@include('includes.adminHeader')
<title>Mistminds | Admin | Field Settings</title>

@section('content')

<div >
    <div style="width:100%; height:50px">&nbsp;</div>
    <div >
        <table cellpadding="0" cellspacing="0" style="width: 100%">
		<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<strong>STATES</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84" valign="middle">
<font face="Calibri" size="3">
				 {{ Form::open(array('url' => '/admin/configuration/savefooterproperties', 'id' => 'form2')) }}

				{{ Form::select('states', $states, $states[0],array('id' => 'stateid','name'=>'states','class' => 'auto-style82','size' => '1')) }}
				<span class="auto-style91">&nbsp;&nbsp; </span>
				<input id="editState" type="button" value="Edit" class="auto-style82" style="width: 62px; height: 28px"><span class="auto-style91">&nbsp;&nbsp;
							</span>
	<input id="deletestate" type="button" value="Delete" class="auto-style82" style="width: 59px; height: 28px"></font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
				{{ Form::hidden('updatingstateid', 0, array('id' => 'updatingstateid')) }}
				
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;"></td>
				<td class="auto-style84" style="height: 22px">
				</td>
				<td class="auto-style77" style="width: 3%; height: 22px;"></td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style80">
				<font size="2" face="Calibri">
			<input id="statetb" type="text" name="statetb" size="18" class="auto-style15" style="width: 137px"><span class="auto-style91">&nbsp; 
				</span> </font>
				<font face="Calibri" size="3">
				<span class="auto-style91">&nbsp; </span>
	<input id="addstate" type="button" value="Add" class="auto-style82"><input id="updatestate" type="button" value="Update" class="auto-style82">
	<input id="clearstate" type="button" value="Clear" class="auto-style82"></font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<strong>INSTITUTION + INSTITUTION SUB-DIVISION</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84" valign="middle">
<font face="Calibri" size="3">
				{{ Form::select('institutions', $institutions, $institutions[0],array('id' => 'instituteid','name'=>'institutions','class' => 'auto-style82','size' => '1')) }}
				<span class="auto-style91">&nbsp;&nbsp; </span>
	<input id="editInstitute" type="button" value="Edit" class="auto-style82" style="width: 62px; height: 28px"><span class="auto-style91">&nbsp;&nbsp;
				</span>
	<input id="deleteinstitute" type="button" value="Delete" class="auto-style82" style="width: 59px; height: 28px"></font></td>
	{{ Form::hidden('updateinstituteid', 0, array('id' => 'updateinstituteid')) }}
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;">&nbsp;</td>
				<td class="auto-style84" style="height: 22px">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%; height: 22px;">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;">&nbsp;</td>
				<td class="auto-style84" style="height: 22px">
<font face="Calibri" size="3">
				{{ Form::select('subinstitutions', $subinstitutions, $subinstitutions[0],array('id' => 'subinstituteid','name'=>'subinstitutions','class' => 'auto-style82','size' => '1')) }}
				<span class="auto-style91">&nbsp;&nbsp; </span>
	<input id="editsubinst" type="button" value="Edit" class="auto-style82" style="width: 62px; height: 28px"><span class="auto-style91">&nbsp;&nbsp;
				</span>
	<input id="deletesubinstitute" type="button" value="Delete" class="auto-style82" style="width: 59px; height: 28px"></font></td>
				<td class="auto-style77" style="width: 3%; height: 22px;">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;">&nbsp;</td>
				<td class="auto-style84" style="height: 22px">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%; height: 22px;">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;">&nbsp;</td>
				<td class="auto-style84" style="height: 22px">
<font face="Calibri" size="3">
				
				{{ Form::select('abbreviation', $abbreviation, 'Select Abbreviation',array('id' => 'abbreviationid','name'=>'abbreviation','class' => 'auto-style82','size' => '1')) }}
				<span class="auto-style91">&nbsp;&nbsp; </span>
	<!--<input type="button" value="Edit" class="auto-style82" style="width: 62px; height: 28px"> --><span class="auto-style91">&nbsp;&nbsp;
				</span>
	<!--<input type="button" value="Delete" class="auto-style82" style="width: 59px; height: 28px"> --></font></td>
				<td class="auto-style77" style="width: 3%; height: 22px;">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;"></td>
				<td class="auto-style84" style="height: 22px">
				</td>
				<td class="auto-style77" style="width: 3%; height: 22px;"></td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style80" valign="middle">
				<font size="2" face="Calibri">
			<input id="institutetb" type="text" name="institutetb" size="18" class="auto-style15" style="width: 178px"><span class="auto-style91">&nbsp; 
				</span> </font>
				<font face="Calibri" size="3">
				<span class="auto-style91">&nbsp; </span>
				<input id="addinstitute" type="button" value="Add Institution" class="auto-style82" style="width: 161px; height: 28px">
				<input id="updateinstitute" type="button" value="Update" class="auto-style82" style="width: 78px;">
				<input id="clearinstitute" type="button" value="Clear" class="auto-style82" style="width: 78px;>&nbsp;&nbsp;&nbsp;
				<font size="2" face="Calibri">
				
				<font face="Calibri" size="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Enter Institution Abbreviation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></font></font></font></font>
				<input id="abbreviationtb" type="text" name="abbreviationtb" size="18" class="auto-style15" style="width: 189px"><font face="Calibri" size="3">&nbsp;&nbsp;&nbsp;&nbsp;
				</font></font></font></font></font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;<br/></td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%; height: 22px;"></td>
				<td class="auto-style84" style="height: 22px">
				</td>
				<td class="auto-style77" style="width: 3%; height: 22px;"></td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style80" valign="middle">
				<font size="2" face="Calibri">
				<input id="subinstitutetb" type="text" name="subinstitutetb" size="18" class="auto-style15" style="width: 178px"><span class="auto-style91">&nbsp; 
				</span> </font>
				<font face="Calibri" size="3">
				<span class="auto-style91">&nbsp; </span>
				<input id="addSubInstitution" type="button" value="Add Sub-Institution" class="auto-style82" style="width: 161px; height: 28px">
				<input id="updatesubinstitute" type="button" value="Update" class="auto-style82" style="width: 78px;">
				<input id="clearsubinstitute" type="button" value="Clear" class="auto-style82" style="width: 78px;">&nbsp;&nbsp;&nbsp;
				<font size="2" face="Calibri">
			
				<font face="Calibri" size="3">&nbsp;&nbsp;&nbsp;&nbsp;
				Enter Sub-Institution Abbreviation</font></font></font></font></font>
				<input id="subinstituteabbrtb" type="text" name="subinstituteabbrtb" size="18" class="auto-style15" style="width: 189px"></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<strong>DATABASE ABBREVIATION</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				@if(count($configurations) > 0)
					Current Abbreviation: {{ $configurations[0]->value }}
<input type="hidden" id="configurationId" value={{ $configurations[0]->id }}/>

				@else
					Current Abbreviation: none
<input type="hidden" id="configurationId" value="0"/>

				@endif</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<font size="2" face="Calibri">
				@if(count($configurations) > 0)
			{{ Form::text('dbabbreviation', $configurations[0]->value, array('id' => 'dbabbreviation','size' => 18, 'class' => 'auto-style15', 'style' => 'width:178px')) }}
			@else
			{{ Form::text('dbabbreviation', '', array('id' => 'dbabbreviation','size' => 18, 'class' => 'auto-style15', 'style' => 'width:178px')) }}
			@endif
			<span class="auto-style91">&nbsp; 
				
			</span> </font>
				<font face="Calibri" size="3">
				<span class="auto-style91">&nbsp; </span>
			<input id="editdbabbreviation" type="button" value="Edit Abbreviation" class="auto-style82" style="width: 161px; height: 28px">&nbsp; </font></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<strong>ABOUT</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				@if(array_key_exists('about',$footers))
				{{ Form::textarea('about', $footers['about']->content, array('style' => 'width:90%',  'rows' => '20', 'cols' => '50')) }}
				@else
				{{ Form::textarea('about', null, array('style' => 'width:90%',  'rows' => '20', 'cols' => '50')) }}
				@endif
				</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<strong>TERMS AND CONDITIONS</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				@if(array_key_exists('termsandconditions',$footers))
				{{ Form::textarea('termsandconditions', $footers['termsandconditions']->content, array('style' => 'width:90%',  'rows' => '20', 'cols' => '50')) }}
				@else
				{{ Form::textarea('termsandconditions', null, array('style' => 'width:90%',  'rows' => '20', 'cols' => '50')) }}
				@endif
				</td>
				
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<strong>HELP</strong></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				@if(array_key_exists('help',$footers))
				{{ Form::textarea('help', $footers['help']->content, array('style' => 'width:90%',  'rows' => '20', 'cols' => '50')) }}
				@else
				{{ Form::textarea('help', null, array('style' => 'width:90%',  'rows' => '20', 'cols' => '50')) }}
				@endif
				</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				&nbsp;</td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			<tr>
				<td class="auto-style77" style="width: 5%">&nbsp;</td>
				<td class="auto-style84">
				<input type="submit" value="SAVE" /></td>
				<td class="auto-style77" style="width: 3%">&nbsp;</td>
			</tr>
			{{ Form::close() }}
			</table>
			
	<p class="auto-style81">&nbsp;</p>

    </div>

    <script type="text/javascript">
		$(document).ready(function(){
				document.getElementById('updatestate').style.display='none';
		document.getElementById('clearstate').style.display='none';
				
		document.getElementById('updateinstitute').style.display='none';
		document.getElementById('clearinstitute').style.display='none';
		
		document.getElementById('updatesubinstitute').style.display='none';
		document.getElementById('clearsubinstitute').style.display='none';
});
		
		$("#instituteid").change(function() {
						
			var e = document.getElementById("instituteid");
			var ind = e.options[e.selectedIndex].value;
			
			if(ind==0)
			{
				//alert('Please select other item');
				var $el = $("#subinstituteid");
				$el.empty();
				$el.append($("<option></option>")
				 .attr("value", 0).text("-- Select subdivision --"));
			}
			else
			{
				var strUser = e.options[e.selectedIndex].text;
				
				var jsn = {{$inst}};
			//	alert(jsn);
				$.each(jsn, function(idx, obj) {
				
			//	alert(obj['abbreviation']);
				if(idx == (e.selectedIndex-1))
				{
					//alert(idx);
					//alert(e.selectedIndex);
					//alert('matched');
					var $abel = $("#abbreviationid");
					$abel.empty();
					$abel.append($("<option></option>").attr("value", 0).text(obj['abbreviation']));
					
					/*$.each(obj, function(idx1, obj1) {
						//if(idx1=='id' && obj1==ind)
					//	alert(idx1);
						//alert(obj1);
					}); */
				}				
			});
			
				
				$.ajax(
				{
			
					type: "GET",
					
					cache: false,
					
					
					
					url: "/admin/document/ajax/institution/"+ind,
										
					success: ajxsuccessmsg,
					
					error: errorAlert
			
				});
			}
		
		});

		function ajxsuccessmsg(data)
		{
			//alert(data);
			
			var $el = $("#subinstituteid");
			$el.empty();
			$.each(JSON.parse(data), function(idx, obj) {
		//	alert(obj);
			$el.append($("<option></option>")
				 .attr("value", idx).text(obj));
			});
 			
		}
		
		$("#editState").click(function() 
		{
			//alert('inside');
			var e = document.getElementById("stateid");
			var ind = e.options[e.selectedIndex].value;
			if(ind==0)
			{
				alert('Please select other item');
			}
			else
			{
				var strUser = e.options[e.selectedIndex].text;
				//alert(strUser);
				$('input:text[name="statetb"]').val(strUser);
				$('input:hidden[name="updatingstateid"]').val(e.options[e.selectedIndex].value);
				document.getElementById('addstate').style.display='none';
				document.getElementById('updatestate').style.display='';
				document.getElementById('clearstate').style.display='';
			}
		
		});
		
		$("#clearstate").click(function() 
		{
			$('input:text[name="statetb"]').val('');
			document.getElementById('addstate').style.display='';
			document.getElementById('updatestate').style.display='none';
			document.getElementById('clearstate').style.display='none';
		});
		
		$("#updatestate").click(function() 
		{
			var v = parseInt($("#updatingstateid").val());
			var vl = $("#statetb").val();
			//alert(v+'  '+vl);
			
			$.ajax(
			{
		
				type: "GET",
				
				cache: false,
				
				data: {"tbval":vl},
				
				url: "/admin/state/updatestate/"+v,
									
				success: successmsg,
				
				error: errorAlert
		
			});
		});
		
		$("#addstate").click(function() 
		{
			var val = $("#statetb").val();
			if(val=='')
			{
				alert('Please enter the state name in the textbox');
			}
			else
			{
				$.ajax(
			{
		
				type: "POST",
				
				cache: false,
				
				data: {"stval":val},
				
				url: "/admin/state",
									
				success: successAdd,
				
				error: errorAlert
		
			});
			
			}

		});
		
		$("#deletestate").click(function() 
		{
			//alert('inside delete');
			var e = document.getElementById("stateid");
			var ind = e.options[e.selectedIndex].value;
			if(ind==0)
			{
				alert('Please select other item');
			}
			else
			{
				$.ajax(
				{
			
					type: "DELETE",
					
					cache: false,
					
					url: "/admin/state/"+ind,
										
					success: successDelete,
					
					error: errorAlert
			
				});
			}
		});
		function errorAlert(e, jqxhr)
		{
		
		alert("Your request was not successful: " + jqxhr);
		
		}
		
		function successmsg(data)
		{
			alert('success!');
			//$("stateid").refresh();
			$('input:text[name="statetb"]').val('');
			document.getElementById('addstate').style.display='';
			document.getElementById('updatestate').style.display='none';
			document.getElementById('clearstate').style.display='none';
			location.reload();
		}
		
		function successAdd()
		{
			alert('added successfully!');
			document.getElementById('clearstate').style.display='none';
			document.getElementById('clearinstitute').style.display='none';
			location.reload();
		}
		
		function successDelete()
		{
			alert('deleted successfully!');
			
			location.reload();
		}
		
		$("#editInstitute").click(function() 
		{
			var e = document.getElementById("instituteid");
			var abbr = document.getElementById("abbreviationid");
			
			var ind = e.options[e.selectedIndex].value;
			if(ind==0)
			{
				alert('Please select other item');
			}
			else
			{
				var strUser = e.options[e.selectedIndex].text;
				//alert(strUser);
				$('input:text[name="institutetb"]').val(strUser);
				$('input:text[name="abbreviationtb"]').val(abbr.options[abbr.selectedIndex].text);
				$('input:hidden[name="updateinstituteid"]').val(e.options[e.selectedIndex].value);
				document.getElementById('addinstitute').style.display='none';
				document.getElementById('updateinstitute').style.display='';
				document.getElementById('clearinstitute').style.display='';
			}
		
		});
		$("#clearinstitute").click(function() 
		{
			$('input:text[name="institutetb"]').val('');
			$('input:text[name="abbreviationtb"]').val('');
			document.getElementById('addinstitute').style.display='';
			document.getElementById('updateinstitute').style.display='none';
			document.getElementById('clearinstitute').style.display='none';
		});
		$("#updateinstitute").click(function() 
		{
			var v = parseInt($("#updateinstituteid").val());
			var abbreviation = $("#abbreviationtb").val();
			var name = $("#institutetb").val();
			//alert(v+'  '+name);
			
			$.ajax(
			{
		
				type: "GET",
				
				cache: false,
				
				data: {"name":name, "abbreviation":abbreviation},
				
				url: "/admin/institution/updateinstitution/"+v,
									
				success: successmsg,
				
				error: errorAlert
		
			});
		});
		
		$("#addinstitute").click(function() 
		{
			var name = $("#institutetb").val();
			var abbreviation = $("#abbreviationtb").val();
			if(name=='' || abbreviation=='')
			{
				alert('Please enter institute name and institution abbreviation in their textboxes');
			}
			else
			{
				$.ajax(
			{
		
				type: "POST",
				
				cache: false,
				
				data: {"name":name, "abbreviation":abbreviation},
				
				url: "/admin/institution",
									
				success: successAdd,
				
				error: errorAlert
		
			});
			
			}

		});
		
		$("#deleteinstitute").click(function() 
		{
			//alert('inside delete');
			var e = document.getElementById("instituteid");
			var ind = e.options[e.selectedIndex].value;
			if(ind==0)
			{
				alert('Please select other item');
			}
			else
			{
				$.ajax(
				{
			
					type: "DELETE",
					
					cache: false,
					
					url: "/admin/institution/"+ind,
										
					success: successDelete,
					
					error: errorAlert
			
				});
			}
		});
		
		$("#editdbabbreviation").click(function()
		{
			
			var dbabbreviationtb = $("#dbabbreviation").val();
			var dbId = $("#configurationId").val();
			if(dbabbreviationtb=='')
			{
				alert('Please enter db abbreviation');
			}
			else
			{
				$.ajax(
				{
			
					type: "POST",
					
					cache: false,
					
					data: {"value":dbabbreviationtb, "id":dbId},
					
					url: "/admin/configuration/updateDBAbbreviation",
										
					success: successdbabbreviation,
					
					error: errorAlert
			
				});
			
			}
			function successdbabbreviation(data)
			{
				alert('success!');
			}
		});
		
		$("#addSubInstitution").click(function() 
		{
			var e = document.getElementById("instituteid");
			var subinstitutetb = $("#subinstitutetb").val();
			var subinstituteabbrtb = $("#subinstituteabbrtb").val();
		//	var subinstitutetb = document.getElementById("subinstitutetb");
			
			var ind = e.options[e.selectedIndex].value;
			//alert('sss'+ind);
			if(ind==0 || subinstitutetb=='' || subinstituteabbrtb=='')
			{
				alert('Please select Institution and Enter Sub-Institution name and Sub-Institution Abbreviation');
			}
			else
			{
				$.ajax(
				{
			
					type: "POST",
					
					cache: false,
					
					data: {"instituteid":ind,"name":subinstitutetb, "abbreviation":subinstituteabbrtb},
					
					url: "/admin/institution-subdivision",
										
					success: successAddSubInstitution,
					
					error: errorAlert
			
				});
			}
		
		});
		function successAddSubInstitution()
		{
			alert('added successfully!');
			document.getElementById('clearstate').style.display='none';
			document.getElementById('clearinstitute').style.display='none';
			document.getElementById('updatesubinstitute').style.display='none';
			document.getElementById('clearsubinstitute').style.display='none';
			location.reload();
		}
		
		$("#editsubinst").click(function() 
		{
			var e = document.getElementById("instituteid");
			var subinstituteabbr = document.getElementById("subinstituteabbrtb");
			
			var ind = e.options[e.selectedIndex].value;
			if(ind==0)
			{
				alert('Please select Institution');
			}
			else
			{
				var subinst = document.getElementById("subinstituteid");
				var subinstind = subinst.options[subinst.selectedIndex].value;
				
				if(subinstind == 0)
				{
					alert('Please select Sub-Institution');
				}
				else
				{
					var strUser = subinst.options[subinst.selectedIndex].text;
					var jsn  ={{ $subinstitutionsValues }};
					var subinstabbr = jsn[ind][subinstind];
					$('input:text[name="subinstitutetb"]').val(strUser);
					$('input:text[name="subinstituteabbrtb"]').val(subinstabbr);
				//	$('input:hidden[name="updatesuinstituteid"]').val(e.options[e.selectedIndex].value);
					document.getElementById('addSubInstitution').style.display='none';
					document.getElementById('updatesubinstitute').style.display='';
					document.getElementById('clearsubinstitute').style.display='';
				}
				
			}
			
			
		});
		
		
		$("#clearsubinstitute").click(function() 
		{
			$('input:text[name="subinstitutetb"]').val('');
			$('input:text[name="subinstituteabbrtb"]').val('');
			document.getElementById('addSubInstitution').style.display='';
			document.getElementById('updatesubinstitute').style.display='none';
			document.getElementById('clearsubinstitute').style.display='none';
		});
		$("#deletesubinstitute").click(function() 
		{
			//alert('inside delete');
			var e = document.getElementById("instituteid");
			var ind = e.options[e.selectedIndex].value;
			if(ind==0)
			{
				alert('Please select Institution');
			}
			else
			{
				var subinst = document.getElementById("subinstituteid");
				var subinstind = subinst.options[subinst.selectedIndex].value;
				
				if(subinstind == 0)
				{
					alert('Please select Sub-Institution');
				}
				else
				{
					$.ajax(
					{
				
						type: "DELETE",
						
						cache: false,
						
						url: "/admin/institution-subdivision/"+subinstind,
											
						success: successDelete,
						
						error: errorAlert
				
					});
				}
				
			}
		});
		
		$("#updatesubinstitute").click(function() 
		{
				var e = document.getElementById("instituteid");
			var ind = e.options[e.selectedIndex].value;
			
			var subinst = document.getElementById("subinstituteid");
			var subinstind = subinst.options[subinst.selectedIndex].value;
				
			var subinstabbr = $("#subinstituteabbrtb").val();
			var name = $("#subinstitutetb").val();
			
			
			$.ajax(
			{
		
				type: "GET",
				
				cache: false,
				
				data: {"name":name, "abbreviation":subinstabbr, "institution_id":ind},
				
				url: "/admin/institution-subdivision/updatesubinstitution/"+subinstind,
									
				success: successmsg,
				
				error: errorAlert
		
			}); 
		
		});
		
	</script>

</div>
