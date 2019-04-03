@extends('layouts.app')

@section('content')
    <h1>Add Job</h1>
    {!! Form::open(['action' => ['JobsController@update', $job->id], 'method' => 'POST']) !!}
        <div class="col-md-6 form-group">
            {{Form::label('title', 'Job Title')}}
            {{Form::text('title', $job->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="col-md-4 form-group">
            {{Form::label('location', 'Job Location')}}
            {{Form::text('location', $job->location, ['class' => 'form-control', 'placeholder' => 'Location'])}}
        </div>
        <div class="col-md-4 form-group">
            {{Form::label('category', 'Category')}}
            {{Form::select('category', array('Software Development' => 'Software Development', 'Networking' => 'Networking', 'Database Management' => 'Database Management',
            'IT Specialist' => 'IT Specialist'), $job->category, ['class' => 'form-control'])}}
        </div>
        <div class="col-md-3 form-group">
            {{Form::label('type', 'Job Type')}}
            {{Form::select('type', array('Contract' => 'Contract', 'Permenant' => 'P&P', 'Internship' => 'Internship', 'Part Time' => 'Part Time'), 
            $job->type, ['class' => 'form-control'])}}
        </div>
        <div class="col-md-3 form-group">
            {{Form::label('experience', 'Years of Experience')}}
            {{Form::number('experience', $job->experience, ['class' => 'form-control', 'placeholder' => '4'])}}
        </div>
        <div class="col-md-4 form-group">
            {{Form::label('qualification', 'Highest Qualifications')}}
            {{Form::select('qualification', array('Certificate' => 'Certificate', 'Dimploma' => 'Diploma', 'Undergraduate Degree' => 'Undegraduate Degree',
            'Master\'s Degree' => 'Master\'s Degree'), $job->qualification, ['class' => 'form-control'])}}
        </div>
        <div class="col-md-3 form-group">
            {{Form::label('salary', 'Salary')}}
            {{Form::number('salary', $job->salary, ['class' => 'form-control', 'placeholder' => 'BWP'])}}
        </div>
        <div class="col-md-3 form-group">
            {{Form::label('closing_date', 'Closing Date')}}
            {{Form::date('closing_date', $job->closing_date, ['class' => 'form-control'])}}
        </div>
        <div class="col-md-10 form-group">
            {{Form::label('description', 'Job Description')}}
            {{Form::textarea('description', $job->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Job Description'])}}
        </div>
        <div class="col-md-10">
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('EDIT JOB', ['class' => 'btn btn-primary'])}}
        </div>
    {!! Form::close() !!}
@endsection