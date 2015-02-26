@extends('layouts.master')

@section('title') Edit State @stop

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif

    <h1><i class='fa fa-user'></i> Edit State</h1>

    {{ Form::model($state, ['role' => 'form', 'url' => '/admin/state/' . $state->id, 'method' => 'PUT']) }}

    <div class='form-group'>
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
    </div>


    <div class='form-group'>
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

</div>

@stop