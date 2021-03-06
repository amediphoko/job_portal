@extends('layouts.app')

@section('content')
        <div class="col-md-3">
            <div class="panel panel-default" id="jobSummary">
                <div class="panel-heading" style="text-align:center;font-weight:600;font-size:1.3em">Job Summary</div>
                <div class="panel-body" style="background-color:aliceblue">
                    <ul style="list-style-type:none">
                        <li>
                            <h5><i class="fa fa-calendar"></i> Posted on</h5> {{$job->created_at->toDateString()}}
                        </li>
                        <li>
                            <h5><i class="fa fa-suitcase"></i> Category</h5> {{$job->category}}
                        </li>
                        <li>
                            <h5><i class="fa fa-tag"></i> Job Type</h5> {{$job->type}}
                        </li>
                        <li>
                            <h5><i class="fa fa-sliders"></i> Years Experience</h5> > {{$job->experience}}
                        </li>
                        <li>
                            <h5><i class="fa fa-graduation-cap"></i> Qualifications</h5> {{$job->qualification}}
                        </li>
                        <li>
                            <h5><i class="fa fa-money"></i> Salary</h5> {{$job->salary}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="jobInfo">
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
                @if (count($applied))
                    {!! Form::open() !!}
                        {{Form::submit('APPLIED', ['class' => 'btn btn-default', 'disabled' => 'disabled'])}}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['action' => 'ApplicationsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{Form::number('id', $job->id.Auth::user()->id, ['class'=>'hidden'])}}
                        {{Form::number('user_id', Auth::user()->id, ['class'=>'hidden'])}}
                        {{Form::number('employer_id', $job->employer->id, ['class'=>'hidden'])}}
                        {{Form::number('job_id', $job->id, ['class'=>'hidden'])}}
                        {{Form::submit('APPLY', ['name' => 'apply', 'class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                @endif
            @elseif (Auth::guard('employer')->user())
                @if (Auth::guard('employer')->user()->id == $job->employer_id)
                    <a href="/jobs/{{$job->id}}/edit" class="btn btn-default">Edit</a>
                    {!!Form::open(['action' => ['JobsController@destroy', $job->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                @endif
            @endif
        </div>
@endsection