@extends('admin.document.index')

@section('content')

@include('includes.adminHeader')
<style>
.auto-style441 {
	text-align: center;
	background-color: #666666;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	color: #FFFFFF;
	font-size: x-small;
}
.auto-style49 {
	white-space: normal;
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style54 {
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
	text-decoration: underline;
}
.auto-style55 {
	white-space: normal;
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
	text-decoration: underline;
}
.auto-style79 {
	text-align: center;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style801 {
	text-align: left;
	font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande", "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
	font-size: small;
	background-color: #FFFFFF;
}
.auto-style821 {
	font-size: medium;
	font-family: Calibri;
}
.auto-style841 {
	text-align: left;
	font-family: Calibri;
	font-size: medium;
	background-color: #FFFFFF;
}
.auto-style86 {
	text-align: left;
	font-size: medium;
	font-family: Calibri;
}
.auto-style87 {
	color: #FF0000;
}

.lblStyle{
text-transform:uppercase;
}

</style>

<div style="width:100%;  ">&nbsp;</div>
<title>Mistminds | Admin | Edit Document</title>
    <div id="innerContent" class="documentEdit">
        <div class='row col-lg-offset-1'>

            @if ($errors->has())
            @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
            @endforeach
            @endif

            
			
				<tr>
					<td class="auto-style77" style="width: 5%">&nbsp;</td>
					<td class="auto-style841">
					<strong>DOCUMENT NUMBER</strong></td>
					<td class="auto-style77" style="width: 3%">&nbsp;</td>
				</tr>
				<tr>
					<td class="auto-style77" style="width: 5%">&nbsp;</td>
					<td class="auto-style801">
					<font size="2" face="Calibri">
					{{ Form::open(['role' => 'form', 'url' => '/admin/document/get', 'id' => 'documentGet']) }}
				<input type="text" name="docnumtb" size="18" class="auto-style15" style="width: 161px"><span class="auto-style91">&nbsp; 
					</span> </font></td>
					<td class="auto-style77" style="width: 3%">&nbsp;</td>
				</tr>
				<tr>
					<td class="auto-style77" style="width: 5%">&nbsp;</td>
					<td class="auto-style801">
					<font face="Calibri" size="3">
					
				{{ Form::submit('FIND', ['class' => 'auto-style821']) }}
				{{ Form::close() }}</font></td>
					<td class="auto-style77" style="width: 3%">&nbsp;</td>
				</tr>
				<tr>
					<td class="auto-style77" style="width: 5%">&nbsp;</td>
					<td class="auto-style76">
					&nbsp;</td>
					<td class="auto-style77" style="width: 3%">&nbsp;</td>
				</tr>
				<tr>
					<td class="auto-style77" style="width: 5%">&nbsp;</td>
					<td class="auto-style76">
					&nbsp;</td>
					<td class="auto-style77" style="width: 3%">&nbsp;</td>
				</tr>
			
			@if ($idNotFound=='1')
			<h4 style="color:red;">Document not found</h4>
			@endif
			
			
			@if ($showEdit=='0')
				{{ Form::open(['role' => 'form', 'url' => '/admin/document', 'id' => 'documentCreate']) }}
            

            @foreach ($fieldMapping as $definition => $fieldGroup)
                @if(in_array($fieldDefinitions[$fieldGroup][$definition]['type'], array('text', 'date')))
                <div class='form-group {{ $fieldGroup }}'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                    {{ Form::text($definition, null, ['size'=>'18', 'class'=>'auto-style15', 'style'=>'width: 965px']) }}
					
                </div>
                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'textarea')
                <div class='form-group {{ $fieldGroup }}'>
					{{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                    {{ Form::textarea($definition, null, ['rows' => $fieldDefinitions[$fieldGroup][$definition]['rows'],'class'=>'auto-style15', 'style'=>'width: 965px; height 137px;']) }}
					
                </div>

                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'select')
                <div class='form-group {{ $fieldGroup }}{{ isset($fieldDefinitions[$fieldGroup][$definition]['group']) ? ' col-xs-6' : '' }}'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                    {{ Form::select($definition, $$fieldDefinitions[$fieldGroup][$definition]['data'], null, array('class' => 'form-control', 'id' => $definition)) }}
                </div>
                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'multi' && $definition == 'ratifications_signatures')
                <div class='form-group {{ $fieldGroup }} bg-info'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                    <div style="clear:both;"></div>
                    @for ($i = 1; $i <= 5; $i++)
                    @include('admin.document.partial.ratification')
                    @endfor
                    <div style="clear:both;"></div>
                    <div class='form-group' id="ratifications-add-row">
                        <a href="#" class="btn btn-primary btn-xs">Add row</a>
                    </div>
                    <input type="hidden" id="nr_of_ratifications" name="nr_of_ratifications" value="5" />
                </div>
                @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'multi' && $definition == 'declarations')
                <div class='form-group {{ $fieldGroup }} bg-info'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
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
		
            {{ Form::close() }}
			@else
			
            {{ Form::model($document, ['role' => 'form', 'url' => '/admin/document/' . $document->id, 'method' => 'PUT']) }}

            <div class='form-group'>
                {{ Form::label('document_id', 'Document id: ' . $document->id) }}
            </div>
			{{ Form::hidden('docid', $document->id, array('id' => 'docid')) }}
			{{ Form::hidden('instid', $document->institution, array('id' => 'instid')) }}
			{{ Form::hidden('typeid', $document->type, array('id' => 'typeid')) }}
			{{ Form::hidden('finalcitation', $document->auto_citation, array('id' => 'finalcitation')) }}
            @foreach ($fieldMapping as $definition => $fieldGroup)
            @if($fieldDefinitions[$fieldGroup][$definition]['type'] == 'text')
                @if($definition == 'tags' && is_array($document->$definition))
                <div class='form-group {{ $fieldGroup }}'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                    {{ Form::text($definition, implode(',',$document->$definition), ['size'=>'18', 'class'=>'auto-style15', 'style'=>'width: 965px']) }}
                </div>
                @else
                <div class='form-group {{ $fieldGroup }}'>
                    {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                    {{ Form::text($definition, $document->$definition, ['size'=>'18', 'class'=>'auto-style15', 'style'=>'width: 965px']) }}
                </div>
                @endif
            @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'date')
            <div class='form-group {{ $fieldGroup }}'>
                {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                {{ Form::text($definition, date('Y-m-d', strtotime($document->$definition)), ['size'=>'18', 'class'=>'auto-style15', 'style'=>'width: 965px']) }}
            </div>
            @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'hidden')
            <div class='form-group {{ $fieldGroup }}'>
                {{ Form::hidden($definition, $document->$definition) }}
            </div>
            @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'textarea')
            <div class='form-group {{ $fieldGroup }}'>
                {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
                {{ Form::textarea($definition, $document->$definition, ['class'=>'auto-style15', 'style'=>'width: 965px; height 137px;', 'rows' => $fieldDefinitions[$fieldGroup][$definition]['rows']]) }}
            </div>

            @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'select')
            <div class='form-group {{ $fieldGroup }}{{ isset($fieldDefinitions[$fieldGroup][$definition]['group']) ? ' col-xs-6' : '' }}'>
            {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
            @if($definition == 'type')
            {{ Form::select('type_disabled', $$fieldDefinitions[$fieldGroup][$definition]['data'], $document->$definition, array('class' => 'form-control', 'id' => $definition, 'disabled' => 'disabled')) }}
            {{ Form::hidden($definition, $document->$definition) }}
            @else
            {{ Form::select($definition, $$fieldDefinitions[$fieldGroup][$definition]['data'], $$fieldDefinitions[$fieldGroup][$definition]['selected'], array('class' => 'form-control', 'id' => $definition)) }}
            @endif
        </div>
        @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'multi' && $definition == 'ratifications_signatures')
        <div class='form-group {{ $fieldGroup }} bg-info'>
            {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
            <div style="clear:both;"></div>
            @for ($i = 1; $i <= $ratification_count; $i++)
            @include('admin.document.admin.ratification')
            @endfor
            <div style="clear:both;"></div>
            <div class='form-group' id="ratifications-add-row">
                <a href="#" class="btn btn-primary btn-xs">Add row</a>
            </div>
            <input type="hidden" id="nr_of_ratifications" name="nr_of_ratifications" value="5" />
        </div>
        @elseif($fieldDefinitions[$fieldGroup][$definition]['type'] == 'multi' && $definition == 'declarations')
        <div class='form-group {{ $fieldGroup }} bg-info'>
            {{ Form::label($definition, $fieldDefinitions[$fieldGroup][$definition]['label'], array('class' => 'lblStyle')) }}
            <div style="clear:both;"></div>
            @for ($i = 1; $i <= $declaration_count; $i++)
            @include('admin.document.admin.declaration')
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
		{{ Form::submit('SAVE CHANGES', ['id' => 'updateDocument','class' => 'auto-style821']) }}<span class="auto-style91">&nbsp;
		&nbsp;
		</span>
		{{ Form::button('DELETE DOCUMENT', ['id' => 'deleteDocument','class' => 'auto-style821']) }}</font></p>

            {{ Form::close() }}
		@endif
        </div>
	
    </div>
	<script type="text/javascript">
		
		$("#deleteDocument").click(function() 
		{
		//	alert('onclick deletedocument');
			var v = $("#docid").val();
			var i = $("#instid").val();
			var t = $("#typeid").val();
		//	alert(v);
		
		$.ajax(
					{
				
						type: "POST",
						
						cache: false,
						
						data: {"docid":v,"instid":i,"typeid":t},
						
						url: "/admin/document/destorydoc",
											
						success: successmsg,
						
						error: errorAlert
				
					});
				
			/*$.ajax(
				{
			
					type: "DELETE",
					
					cache: false,
					
					url: "/admin/document/"+v,
										
					success: successmsg,
					
					error: errorAlert
			
				});*/
		});
		
		function errorAlert(e, jqxhr)
		{
			alert("Your request was not successful: " + jqxhr);
		}
		
		function successmsg()
		{
			alert('success!');
			window.location.href = '/admin/document/editindex'; 
		}
	</script>
@stop