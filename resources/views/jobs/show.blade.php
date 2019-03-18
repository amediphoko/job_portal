@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center">Job Summary</div>
                <div class="panel-body" style="background-color:aliceblue">
                    <ul style="list-style-type:none">
                        <li>
                            <h5>Posted on</h5> {{$job->created_at}}
                        </li>
                        <li>
                            <h5><i class="fa fa-suitcase"></i> Category</h5> {{$job->category}}
                        </li>
                        <li>
                            <h5>Job Type</h5> {{$job->type}}
                        </li>
                        <li>
                            <h5>Years Experience</h5> > {{$job->experience}}
                        </li>
                        <li>
                            <h5>Qualifications</h5> {{$job->qualification}}
                        </li>
                        <li>
                            <h5>Salary</h5>  > {{$job->salary}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8" id="jobInfo">
            <a href="/jobs/" class="btn btn-default"><i class="fa fa-chevron-left"></i>
                View All Jobs</a>
            <h2>{{$job->title}}</h2>
            <p><i class="fa fa-building"></i> Company: <b>{{$job->employer->name}}</b></p>
            <p><i class="fa fa-map-marker"></i> Location: <b>{{$job->location}}</b></p>
            <p><i class="fa fa-calendar-times-o"></i> Closing Date: <b>{{$job->closing_date}}</b></p>
            <h4><b>Job Description</b></h4>
            <div>
                {!! $job->description !!}
            </div>
            @if (Auth::user())
            {!! $job->application !!}
                {!! Form::open(['action' => 'ApplicationsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    {{Form::number('id', $job->id.Auth::user()->id, ['class'=>'hidden'])}}
                    {{Form::number('user_id', Auth::user()->id, ['class'=>'hidden'])}}
                    {{Form::number('employer_id', $job->employer->id, ['class'=>'hidden'])}}
                    {{Form::number('job_id', $job->id, ['class'=>'hidden'])}}
                    {{Form::text('documents', Auth::user()->documents, ['class'=>'hidden'])}}
                    {{Form::submit('APPLY', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            @endif
        </div>
    </div>
@endsection