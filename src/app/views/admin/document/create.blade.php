@extends('admin.document.index')
@include('includes.adminHeader')
<style>

.auto-style84 {
	text-align: left;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: medium;
	background-color: #FFFFFF;
}
.auto-style86 {
	text-align: left;
	font-size: medium;
}

</style>
<title>Mistminds | Admin | New Document</title>
<div style="width:100%; height:120px">&nbsp;</div>
    <div id="innerContent" class="documentEdit" style="margin-left:10%;margin-right:5%;">
        <div class='row col-lg-offset-1'>
 
            @if ($errors->has())
            @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
            @endforeach
            @endif
			
            {{ Form::open(['role' => 'form', 'url' => '/admin/document', 'id' => 'documentCreate']) }}


            @foreach ($fieldMapping as $definition => $fieldGroup)
                @if(in_array($fieldDefinitions[$fieldGroup][$definition]['type'], array('text', 'date')))
                <div class='form-group {{ $fieldGroup }}'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'auto-style84')) }}
                    {{ Form::text($definition, null, ['size'=>'18', 'class'=>'auto-style15', 'style'=>'width: 965px']) }}
					
                </div>
				@elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'label')
                <div class='form-group {{ $fieldGroup }}'>
					{{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'auto-style84')) }}
					<span id="citationval" name="citationval" class="auto-style84"> </span>
					<input type="hidden" value="" name="finalcitation" id="finalcitation"/>
                  <!--  {{ Form::label('', '', ['id'=>'citationval' , 'class'=>'auto-style84',  'style'=>'width: 500px;']) }} -->
					
					
                </div>
                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'textarea')
                <div class='form-group {{ $fieldGroup }}'>
					{{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'auto-style84')) }}
                    {{ Form::textarea($definition, null, ['rows' => $fieldDefinitions[$fieldGroup][$definition]['rows'],'class'=>'auto-style15', 'style'=>'width: 965px; height 137px;']) }}
					
                </div>

                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'select')
                <div class='form-group {{ $fieldGroup }}{{ isset($fieldDefinitions[$fieldGroup][$definition]['group']) ? ' col-xs-6' : '' }}'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'auto-style84')) }}
                    {{ Form::select($definition, $$fieldDefinitions[$fieldGroup][$definition]['data'], null, array('class' => 'form-control', 'id' => $definition)) }}
                </div>
                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'multi' && $definition == 'ratifications_signatures')
                <div class='form-group {{ $fieldGroup }} bg-info'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'] , array('class' => 'auto-style84')) }}
                    <div style="clear:both;"></div>
                    @for ($i = 1; $i <= 5; $i++)
                    @include('admin.document.partial.ratification')
                    @endfor
                    <div style="clear:both;"> </div>
                    <div class='form-group' id="ratifications-add-row">
                        <a href="#" class="btn btn-primary btn-xs">Add row</a>
                    </div>
                    <input type="hidden" id="nr_of_ratifications" name="nr_of_ratifications" value="5" />
                </div>
                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'multi' && $definition == 'declarations')
                <div class='form-group {{ $fieldGroup }} bg-info'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'auto-style84')) }}
                    <div style="clear:both;"></div>
                    @for ($i = 1; $i <= 5; $i++)
                    @include('admin.document.partial.declaration')
                    @endfor
                    <div class='form-group' id="declarations-add-row">
                        <a href="#" class="btn btn-primary btn-xs">Add row</a>
                    </div>
                    <div style="clear:both;"></div>
                    <input type="hidden" id="nr_of_declarations" name="nr_of_declarations" value="5" />
                </div>
                @endif

            @endforeach
			
            <p class="auto-style81"><font face="Calibri" size="3">
				
				{{ Form::submit('Create document', ['class' => 'auto-style82', 'style' => 'font-family: Calibri;']) }}</font></p>
				{{ Form::hidden('nextid', $nextId, array('id' => 'nextid')) }}
				{{ Form::hidden('projectabbreviation', $projectAbbreviation, array('id' => 'projectabbreviation')) }} 
				<input type="hidden" value="{{$projectAbbreviation}}" name="productabb" id="productabb"/>
            {{ Form::close() }}
			
			 

        </div>

    </div>
</div>
<script type="text/javascript">
var citationvalue = '';
var nextId=parseInt($("#nextid").val());
var type = 0;
//var projectAbbreviation = $("#projectabbreviation").text();
var productabb = $("#productabb").val();
var institutionabbreviation ='';
var institutionyear = '';
var institutionindex = 0;


var myVar=setInterval(function () {
	
	var e = document.getElementById("type");
	var ind = e.options[e.selectedIndex].value;
	var strDate = document.getElementById("date").value;
	var institutionDate = new Date(strDate);
	//alert(institutionDate);
	var year = institutionDate.getFullYear();
	//alert($("#finalcitation").val());
	var inst = document.getElementById("institution");
	var instind = inst.options[inst.selectedIndex].value;
	var yrNan = isNaN(year);
	if(ind != type || institutionindex != instind || yrNan == false)
	{
//	alert('ajax call');
		 
	//alert(ind);
	
		if(ind=='decision')
		{
			var inst = document.getElementById("institution");
			var instind = inst.options[inst.selectedIndex].value;
			
		//	alert(instind);
			if(instind==0)
			{
				//alert('Please select other item');
				$.ajax(
					{
				
						type: "POST",
						
						cache: false,
						
						data: {"type":ind,"year":year},
						
						url: "/admin/document/getSerial",
											
						success: success,
						
						error: errorAlert
				
					});
					
					function success(data)
					{
						//alert(data);
						nextId = data;
						institutionyear = year;
						if(isNaN(institutionyear)){ institutionyear='';}
						type=ind;
						institutionindex = instind;
						citationvalue = institutionyear+' '+productabb+'.'+' '+nextId;
						$('#citationval').html(citationvalue);
						$('#finalcitation').val(citationvalue);
					}
					function errorAlert(e, jqxhr)
					{
					 responseText = jqxhr.responseText;
					 alert(responseText);
					alert("Your request was not successful: " + jqxhr);
					
					}
			//	citationvalue = institutionyear+' '+productabb+'.'+' '+nextId;
			//	$('#citationval').html(citationvalue).style('text-color:red;'); 
			//	$('input:hidden[name="finalcitation"]').val(citationvalue);
			}
			else
			{
				var jsn  ={{ $abbreviation }};
				institutionabbreviation = jsn[instind];
				institutionyear = year;
				if(isNaN(institutionyear)){ institutionyear='';}
				type=ind;
				institutionindex = instind;
				citationvalue = institutionyear+' '+productabb+'.'+institutionabbreviation+' '+nextId;
			//	alert(citationvalue);
				$('#citationval').html(citationvalue); 
				$('#finalcitation').val(citationvalue);
			}
			
		}
		else if(ind=='treaty')
		{
			
			institutionabbreviation = 'Treaty';
			institutionyear = year;
			if(isNaN(institutionyear)){ institutionyear='';}
				type=ind;
				institutionindex = instind;
			citationvalue = institutionyear+' '+productabb+'.'+institutionabbreviation+' '+nextId;
			//alert(citationvalue);
			$('#citationval').html(citationvalue);
			$('#finalcitation').val(citationvalue);			
			
			
		}
		else if(ind=='commentary')
		{
			institutionabbreviation = 'Commentary';
			institutionyear = year;
			if(isNaN(institutionyear)){ institutionyear='';}
				type=ind;
				institutionindex = instind;
			citationvalue = institutionyear+' '+productabb+'.'+institutionabbreviation+' '+nextId;
		//	alert(citationvalue);
			$('#citationval').html(citationvalue); 
			$('#finalcitation').val(citationvalue);
		}
	}
	else
	{}
}, 500);


		
</script>

