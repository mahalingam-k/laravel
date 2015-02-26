@extends('layouts.master')

@section('title') Welcome, {{$fullname or 'user'}} @stop

@section('content')
    @include('includes.adminHeader')
@stop
