<div class='form-group'>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-state-'.$i, 'State') }}
		@if(isset($ratifications_array[$i-1][0]))
			{{ Form::select($definition . '-state-'.$i, $states, $ratifications_array[$i-1][0], array('class' => 'form-control', 'id' => $definition . '-state-'.$i)) }}
		@else
			{{ Form::select($definition . '-state-'.$i, $states, null, array('class' => 'form-control', 'id' => $definition . '-state-'.$i)) }}
		@endif
    </div>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-signed-'.$i, 'Signed') }}
		@if(isset($ratifications_array[$i-1][1]))
			{{ Form::text($definition . '-signed-'.$i, $ratifications_array[$i-1][1], array('class' => 'form-control date-picker', 'id' => $definition . '-signed-'.$i)) }}
		@else
			{{ Form::text($definition . '-signed-'.$i, null, array('class' => 'form-control date-picker', 'id' => $definition . '-signed-'.$i)) }}
		@endif
    </div>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-ratified-'.$i, 'Ratified/Accessed') }}
		@if(isset($ratifications_array[$i-1][2]))
			{{ Form::text($definition . '-ratified-'.$i, $ratifications_array[$i-1][2], array('class' => 'form-control date-picker', 'id' => $definition . '-ratified-'.$i)) }}
		@else
			{{ Form::text($definition . '-ratified-'.$i, null, array('class' => 'form-control date-picker', 'id' => $definition . '-ratified-'.$i)) }}
		@endif
    </div>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-accessed-'.$i, 'Deposited') }}
		@if(isset($ratifications_array[$i-1][3]))
			{{ Form::text($definition . '-accessed-'.$i, $ratifications_array[$i-1][3], array('class' => 'form-control date-picker', 'id' => $definition . '-accessed-'.$i)) }}
		@else
			{{ Form::text($definition . '-accessed-'.$i, null, array('class' => 'form-control date-picker', 'id' => $definition . '-accessed-'.$i)) }}
		@endif        
    </div>
</div>