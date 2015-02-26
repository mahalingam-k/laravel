@extends('layouts.master')

@section('title') Create Institution @stop

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    @if ($errors->has())
    @foreach ($errors->all() as $error)
    <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
    @endif

    <h1><i class='fa fa-user'></i> Edit Institution</h1>

    {{ Form::model($institution, ['role' => 'form', 'url' => '/admin/institution/' . $institution->id, 'method' => 'PUT']) }}

    <div class='form-group'>
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('abbreviation', 'Abbreviation') }}
        {{ Form::text('abbreviation', null, ['placeholder' => 'Abbreviation', 'class' => 'form-control']) }}
    </div>


    <div class='form-group'>
        {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

</div>

@stop