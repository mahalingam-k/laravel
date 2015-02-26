@extends('admin.document.index')

@section('title') Document Database @stop

@section('content')

    @include('includes.adminHeader')

    @include('includes.admin.document.sidebar')
    <div id="innerContent" class="documentEdit">
        <div class='row col-lg-offset-1'>

            @if ($errors->has())
            @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
            @endforeach
            @endif

            <h4><i class='fa fa-pencil'></i>Edit document</h4>

            {{ Form::model($document, ['role' => 'form', 'url' => '/admin/document/' . $document->id, 'method' => 'PUT']) }}

            <div class='form-group'>
                {{ Form::label('document_id', 'Document id: ' . $document->id) }}
            </div>

            <div class='form-group'>
                {{ Form::label('type', 'Type') }}
                {{ Form::select('type', $types, $document->type, array('class' => 'form-control', 'id' => 'documentEdit')) }}
            </div>

            <div class='form-group'>
                {{ Form::label('institution', 'Institution') }}
                {{ Form::select('institution', $institutions, $selectedInstitution, array('class' => 'form-control', 'id' => 'institutionSelect')) }}
            </div>

            <div class='form-group'>
                {{ Form::label('institution_subdivision', 'Institution subdivision') }}
                {{ Form::select('institution_subdivision', $institutionSubdivisions, $selectedSubdivision, array('class' => 'form-control', 'id' => 'institutionSelect')) }}
            </div>

            <div class='form-group'>
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', $document->title, ['placeholder' => 'Title', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('title_short', 'Title short') }}
                {{ Form::text('title_short', $document->title_short, ['placeholder' => 'Title short', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('applicant', 'Applicant') }}
                {{ Form::text('applicant', $document->applicant, ['placeholder' => 'Applicant', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('respondent', 'Respondent') }}
                {{ Form::text('respondent', $document->respondent, ['placeholder' => 'Respondent', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('victims', 'Victims') }}
                {{ Form::text('victims', $document->victims, ['placeholder' => 'Victims', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('represented_by', 'Represented by') }}
                {{ Form::text('represented_by', $document->represented_by, ['placeholder' => 'Represented by', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('decided_by', 'Decided by') }}
                {{ Form::text('decided_by', $document->decided_by, ['placeholder' => 'Decided by', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('file_no', 'File no.') }}
                {{ Form::text('file_no', $document->file_no, ['placeholder' => 'File no.', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('citation', 'Citation') }}
                {{ Form::text('citation', $document->citation, ['placeholder' => 'Citation', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('date', 'Date') }}
                {{ Form::text('date', date('Y-m-d', strtotime($document->date)), ['placeholder' => 'yyyy-mm-dd', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('tags', 'Tags') }}
                {{ Form::text('tags', $document->tags, ['placeholder' => 'Tags', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('body', 'Body') }}
                {{ Form::textarea('body', $document->body, ['class' => 'form-control', 'rows' => 15]) }}
            </div>

            <div class='form-group'>
                {{ Form::label('editors_note_public', 'Public Editor\'s Note') }}
                {{ Form::textarea('editors_note_public', $document->editors_note_public, ['class' => 'form-control', 'rows' => 4]) }}
            </div>

            <div class='form-group'>
                {{ Form::label('editors_note_private', 'Private Editor\'s Note') }}
                {{ Form::textarea('editors_note_private', $document->editors_note_private, ['class' => 'form-control', 'rows' => 4]) }}
            </div>

            <div class='form-group'>
                {{ Form::label('publication', 'Publication') }}
                {{ Form::text('publication', $document->publication, ['placeholder' => 'Publication', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::submit('Update document', ['class' => 'btn btn-primary']) }}
            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop