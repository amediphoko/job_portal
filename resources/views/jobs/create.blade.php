@extends('employer')

@section('subcontent')
    <div class="create-job container">
        <h4>Add Job</h4><hr>
        {!! Form::open(['action' => 'JobsController@store', 'method' => 'POST']) !!}
            <div class="col-md-6 form-group">
                {{Form::label('title', 'Job Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="col-md-4 form-group">
                {{Form::label('location', 'Job Location')}}
                {{Form::text('location', '', ['class' => 'form-control', 'placeholder' => 'Location'])}}
            </div>
            <div class="col-md-4 form-group">
                {{Form::label('category', 'Category')}}
                {{Form::select('category', array('Software Development' => 'Software Development', 'Networking' => 'Networking', 'Database Management' => 'Database Management',
                'IT Specialist' => 'IT Specialist'), 'Software Development', ['class' => 'form-control'])}}
            </div>
            <div class="col-md-3 form-group">
                {{Form::label('type', 'Job Type')}}
                {{Form::select('type', array('Contract' => 'Contract', 'Permenant' => 'P&P', 'Internship' => 'Internship', 'Part Time' => 'Part Time'), 
                'Contract', ['class' => 'form-control'])}}
            </div>
            <div class="col-md-3 form-group">
                {{Form::label('experience', 'Years of Experience')}}
                {{Form::number('experience', '', ['class' => 'form-control', 'placeholder' => '4'])}}
            </div>
            <div class="col-md-4 form-group">
                {{Form::label('qualification', 'Highest Qualifications')}}
                {{Form::select('qualification', array('Certificate' => 'Certificate', 'Dimploma' => 'Diploma', 'Undergraduate Degree' => 'Undegraduate Degree',
                'Master\'s Degree' => 'Master\'s Degree'), 'Undegraduate Degree', ['class' => 'form-control'])}}
            </div>
            <div class="col-md-3 form-group">
                {{Form::label('salary', 'Salary')}}
                {{Form::number('salary', '', ['class' => 'form-control', 'placeholder' => 'BWP'])}}
            </div>
            <div class="col-md-3 form-group">
                {{Form::label('closing_date', 'Closing Date')}}
                {{Form::date('closing_date', '', ['class' => 'form-control'])}}
            </div>
            <div class="col-md-10 form-group">
                {{Form::label('description', 'Job Description')}}
                {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Job Description'])}}
            </div>
            <div class="col-md-10">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        {!! Form::close() !!}
    </div>
@endsection