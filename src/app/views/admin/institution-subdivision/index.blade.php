@extends('layouts.master')

@section('title') Institution Administration @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <header class="row">
        @include('includes.adminHeader')
    </header>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Name</th>
                <th>Date/Time Added</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach ($institutions as $institution)
            <tr>
                <td>{{ $institution->name }}</td>
                <td>{{ $institution->created_at->format('F d, Y h:ia') }}</td>
                <td>
                    <a href="/admin/institution/{{ $institution->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    {{ Form::open(['url' => '/admin/institution/' . $institution->id, 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="/admin/institution/create" class="btn btn-success">Add Institution</a>

</div>

@stop