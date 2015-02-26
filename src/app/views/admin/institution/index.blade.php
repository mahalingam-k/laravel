@extends('layouts.master')

@section('title') Institution Administration @stop

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <header class="row">
        @include('includes.adminHeader')
    </header>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">

            <thead>
            <tr>
                <th>Name</th>
                <th>Abbreviation</th>
                <th>Date/Time Added</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach ($institutions as $institution)
            <tr>
                <td>
                    {{ $institution->name }}
                    @if($institution->subdivisions()->count())
                    <a href="#" id="institution-{{ $institution->id }}" class="open-subdivisions"><i class="fa fa-plus-square pull-right"></i></a>
                    @endif
                </td>
                <td>
                    {{ $institution->abbreviation }}
                </td>
                <td>{{ $institution->created_at->format('F d, Y h:ia') }}</td>
                <td>
                    <a href="/admin/institution/{{ $institution->id }}/edit" class="btn btn-primary btn-xs pull-left" style="margin-right: 3px;">Edit</a>
                    <a href="/admin/institution-subdivision/create?institution={{ $institution->id }}" class="btn btn-info btn-xs pull-left" style="margin-right: 3px;">Add Subdivision</a>
                    {{ Form::open(['url' => '/admin/institution/' . $institution->id, 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs'])}}
                    {{ Form::close() }}
                </td>
            </tr>
            @foreach($institution->subdivisions as $subdivision)
            <tr class="active subdivision info institution-{{ $institution->id }}">
                <td><i class="fa fa-long-arrow-right"></i> {{ $subdivision->name }}</td>
                <td>{{ $subdivision->abbreviation }}</td>
                <td>{{ $subdivision->created_at->format('F d, Y h:ia') }}</td>
                <td>
                    <a href="/admin/institution-subdivision/{{ $subdivision->id }}/edit" class="btn btn-primary btn-xs pull-left" style="margin-right: 3px;">Edit</a>
                    {{ Form::open(['url' => '/admin/institution-subdivision/' . $subdivision->id, 'method' => 'DELETE']) }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs btn-delete'])}}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="/admin/institution/create" class="btn btn-success">Add Institution</a>

</div>

@stop