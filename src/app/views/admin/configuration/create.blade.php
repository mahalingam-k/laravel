@extends('layouts.master')

@section('title') Create Configuration @stop

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif

    <h1><i class='fa fa-user'></i> Add Configuration</h1>

    {{ Form::open(['role' => 'form', 'url' => '/admin/configuration']) }}

    <div class='form-group'>
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('value', 'Value') }}
        {{ Form::textarea('value', null, ['placeholder' => 'Value', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

</div>

@stop