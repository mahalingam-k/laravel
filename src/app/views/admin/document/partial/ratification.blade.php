<div class='form-group'>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-state-'.$i, 'State') }}
        {{ Form::select($definition . '-state-'.$i, $states, null, array('class' => 'form-control', 'id' => $definition . '-state-'.$i)) }}
    </div>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-signed-'.$i, 'Signed') }}
        {{ Form::text($definition . '-signed-'.$i, null, array('class' => 'form-control date-picker', 'id' => $definition . '-signed-'.$i)) }}
    </div>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-ratified-'.$i, 'Ratified/Accessed') }}
        {{ Form::text($definition . '-ratified-'.$i, null, array('class' => 'form-control date-picker', 'id' => $definition . '-ratified-'.$i)) }}
    </div>
    <div class='form-group col-xs-3'>
        {{ Form::label($definition . '-accessed-'.$i, 'Deposited') }}
        {{ Form::text($definition . '-accessed-'.$i, null, array('class' => 'form-control date-picker', 'id' => $definition . '-accessed-'.$i)) }}
    </div>
</div>