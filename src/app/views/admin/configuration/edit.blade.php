@extends('layouts.master')

@section('title') Edit Configuration @stop

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif

    <h1><i class='fa fa-user'></i> Edit Configuration</h1>

    {{ Form::model($configuration, ['role' => 'form', 'url' => '/admin/configuration/' . $configuration->id, 'method' => 'PUT']) }}

    <div class='form-group'>
        {{ Form::label('name', 'Name:') }}
        {{ Form::label('name', $configuration->name) }}
    </div>

    <div class='form-group'>
        {{ Form::label('value', 'Value') }}
        {{ Form::text('value', null, ['placeholder' => 'Value', 'class' => 'form-control']) }}
    </div>


    <div class='form-group'>
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

</div>

@stop