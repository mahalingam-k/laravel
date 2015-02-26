@extends('layouts.frontend')

@section('content')
    @include('includes.menu')

    <header>
        {{ Form::open(array('method' => 'GET')) }}
        <div class="input-group">
            {{ Form::label('q', 'Document search:') }}
        </div>

        <div class="input-group">

            {{ Form::text('q', Input::get('q'), array('class' => 'form-control input-lg', 'placeholder' => 'Enter your search term')) }}
            <span class="input-group-btn">
                {{ Form::submit('Search', array('class' => 'btn btn-primary btn-lg')) }}
            </span>
        </div>
        {{ Form::close() }}
    </header>

    @if (isset($resultset))
    <header>
        <p>Your search yielded <strong>{{ $resultset->getNumFound() }}</strong> results:</p>
        <hr />
    </header>

    <table class=".table-stiped">
        <tr>
            <th>Title</th>
            <th>Author</th>
        </tr>

        @foreach ($resultset as $document)
        <tr>
            <td><a href="{{ Document::getPermalink($document->id) }}"</a>{{ $document->title }}</td>
            <td>{{ $document->author }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <ul>
        @foreach($institutions as $institution)
        <li>
            {{ Form::checkbox('institution', $institution->id) }}
            <a href="/browse/{{ $institution->id }}">{{ $institution->name }} ({{ $institution->document_count }})</a>

        </li>
        @endforeach
    </ul>
    @endif

@endsection