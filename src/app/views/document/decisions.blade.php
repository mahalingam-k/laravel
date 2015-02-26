@extends('layouts.frontend')

@section('content')
@include('includes.menu')

@if (isset($resultset))

<table class="table table-striped table-hover">
    <tr>
    @foreach ($tableHeader as $key => $headerColumn)
        <th>
            <a href="{{ $headerColumn['link'] }}">
                {{ $headerColumn['name'] }}
                @if($sortParam == $key)
                <i class="fa {{ $headerColumn['cssClass'] }}"></i>
                @endif
            </a>
        </th>
    @endforeach
    </tr>

    @foreach ($resultset as $document)
    <tr>
        <td>{{ ucfirst($document->document_type) }}</td>
        <td><a href="{{ Document::getPermalink($document->id) }}"</a>{{ $document->title }}</td>
        <td>{{ $document->institution }}</td>
        <td>{{ substr($document->date, 0, 4) }}</td>
    </tr>
    @endforeach
</table>
@endif

@endsection