<div class='form-group'>
    <div class='form-group col-xs-3'>
        {{ Form::label('declarations-state-'.$i, 'State') }}
		@if(isset($declarations_array[$i-1][0]))
			{{ Form::select('declarations-state-'.$i, $states, $declarations_array[$i-1][0] , array('class' => 'form-control', 'id' => 'declarations-state-'.$i)) }}
		@else
			{{ Form::select('declarations-state-'.$i, $states, null, array('class' => 'form-control', 'id' => 'declarations-state-'.$i)) }}
		@endif	
    </div>
    <div class='form-group col-xs-9'>
        {{ Form::label('declarations-text-'.$i, 'Text of declaration, reservation or understanding') }}
		@if(isset($declarations_array[$i-1][1]))
			{{ Form::textarea('declarations-text-'.$i, $declarations_array[$i-1][1], array('class' => 'form-control', 'id' => 'declarations-text-'.$i, 'rows' => 8)) }}
		@else
			{{ Form::textarea('declarations-text-'.$i, null, array('class' => 'form-control', 'id' => 'declarations-text-'.$i, 'rows' => 8)) }}
		@endif	
    </div>
</div>