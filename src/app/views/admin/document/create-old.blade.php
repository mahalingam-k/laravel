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

            <h4><i class='fa fa-pencil'></i> Create new document</h4>

            {{ Form::open(['role' => 'form', 'url' => '/admin/document', 'id' => 'documentCreate']) }}

            <div class='form-group'>
                {{ Form::label('document_type', 'Document Type') }}
                {{ Form::select('document_type', $documentTypes, null, array('class' => 'form-control')) }}
            </div>

            <div class='form-group'>
                {{ Form::label('institution', 'Institution') }}
                {{ Form::text('institution', null, ['placeholder' => 'Institution', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('institution_subdivision', 'Institution subdivision') }}
                {{ Form::text('institution_subdivision', null, ['placeholder' => 'Institution subdivision', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('title_short', 'Title short') }}
                {{ Form::text('title_short', null, ['placeholder' => 'Title short', 'class' => 'form-control']) }}
            </div>

            <div class='form-group commentary'>
                <div class='form-group'>
                    {{ Form::label('applicant', 'Applicant') }}
                    {{ Form::text('applicant', null, ['placeholder' => 'Applicant', 'class' => 'form-control']) }}
                </div>

                <div class='form-group'>
                    {{ Form::label('respondent', 'Third Parties/Victims') }}
                    {{ Form::text('respondent', null, ['placeholder' => 'Third Parties/Victims', 'class' => 'form-control']) }}
                </div>

                <div class='form-group'>
                    {{ Form::label('victims', 'Victims') }}
                    {{ Form::text('victims', null, ['placeholder' => 'Victims', 'class' => 'form-control']) }}
                </div>

                <div class='form-group'>
                    {{ Form::label('represented_by', 'Represented by') }}
                    {{ Form::text('represented_by', null, ['placeholder' => 'Represented by', 'class' => 'form-control']) }}
                </div>

                <div class='form-group'>
                    {{ Form::label('decided_by', 'Decided by') }}
                    {{ Form::text('decided_by', null, ['placeholder' => 'Decided by', 'class' => 'form-control']) }}
                </div>
            </div>

            <div class='form-group'>
                {{ Form::label('file_no', 'File no.') }}
                {{ Form::text('file_no', null, ['placeholder' => 'File no.', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('citation', 'Citation') }}
                {{ Form::text('citation', null, ['placeholder' => 'Citation', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('date', 'Date') }}
                {{ Form::text('date', null, ['placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('tags', 'Tags') }}
                {{ Form::text('tags', null, ['placeholder' => 'Tags', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('body', 'Body') }}
                {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => 15]) }}
            </div>

            <div class='form-group'>
                {{ Form::label('in_force_from', 'In force from') }}
                {{ Form::text('in_force_from', null, ['placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('in_force_until', 'In force unit') }}
                {{ Form::text('in_force_until', null, ['placeholder' => 'YYYY-MM-DD', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::label('editors_note_public', 'Public Editor\'s Note') }}
                {{ Form::textarea('editors_note_public', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>

            <div class='form-group'>
                {{ Form::label('editors_note_private', 'Private Editor\'s Note') }}
                {{ Form::textarea('editors_note_private', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>

            <div class='form-group'>
                {{ Form::label('publication', 'Publication') }}
                {{ Form::text('publication', null, ['placeholder' => 'Publication', 'class' => 'form-control']) }}
            </div>

            <div class='form-group'>
                {{ Form::submit('Create document', ['class' => 'btn btn-primary']) }}
            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop