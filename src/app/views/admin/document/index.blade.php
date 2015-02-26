@extends('admin.index')
<title>Mistminds | Admin | Edit Document</title>
@section('content')

    @include('includes.adminHeader')
 <!--   @include('includes.admin.document.sidebar')

{{ Form::open(array('method' => 'GET')) }}

<div id="innerContent">
    <div class='row col-lg-offset-1'>
        <div class="input-group">
            {{ Form::text('q', Input::get('q'), array('class' => 'form-control input-lg', 'placeholder' => 'Enter your search term')) }}
                <span class="input-group-btn">
                    {{ Form::submit('Search', array('class' => 'btn btn-primary btn-lg')) }}
                </span>
        </div>
    </div>
</div>
{{ Form::close() }}

@if (isset($resultset))
<header>
    <p>Your search yielded <strong>{{ $resultset->getNumFound() }}</strong> results:</p>
    <hr />
</header>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">

        <thead>
        <tr>
            <th>Id</th>
            <th>Type</th>
            <th>Title</th>
            <th>Institution</th>
            <th>Date</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        @foreach ($resultset as $document)
        <tr>
            <td>{{ $document->id }}</td>
            <td>{{ $document->type }}</td>
            <td>{{ $document->title }}</td>
            <td>{{ $document->institution }}</td>
            <td>{{ Document::convertDateFromSolrFormat($document->date) }}</td>
            <td>
                <a href="/admin/document/{{ $document->id }}/edit" class="btn btn-info btn-xs pull-left" style="margin-right: 3px;">Edit</a>
                {{ Form::open(['url' => '/admin/document/' . $document->id, 'method' => 'DELETE']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-xs delete-document'])}}
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>

    </table>
</div>

<a href="/admin/document/create" class="btn btn-success btn-xs">Add Document</a> 

@endif -->

@stop
