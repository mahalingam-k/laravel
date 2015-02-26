<div class='form-group'>
    <div class='form-group col-xs-3'>
        {{ Form::label('declarations-state-'.$i, 'State') }}
        {{ Form::select('declarations-state-'.$i, $states, null, array('class' => 'form-control', 'id' => 'declarations-state-'.$i)) }}
    </div>
    <div class='form-group col-xs-9'>
        {{ Form::label('declarations-text-'.$i, 'Text of declaration, reservation or understanding') }}
        {{ Form::textarea('declarations-text-'.$i, null, array('class' => 'form-control', 'id' => 'declarations-text-'.$i, 'rows' => 8)) }}
    </div>
</div>