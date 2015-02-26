@extends('layouts.master')

@section('title') State Administration @stop

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
            @foreach ($states as $state)
            <tr>
                <td>{{ $state->name }}</td>
                <td>{{ $state->created_at->format('F d, Y h:ia') }}</td>
                <td>
                    <a href="/admin/state/{{ $state->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    {{ Form::open(['url' => '/admin/state/' . $state->id, 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="/admin/state/create" class="btn btn-success">Add State</a>

</div>

@stop