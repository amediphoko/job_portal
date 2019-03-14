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
                            <h5>Category</h5> {{$job->category}}
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
        <div class="col-md-8">
            <a href="/jobs/" class="btn btn-default"><i class="fa-lg fa-chevron-left"></i>
                View All Jobs</a>
            <h1>{{$job->title}}</h1>
            <h5 style="padding:0.2em">Company: <b>{{$job->employer->name}}</b> Location: <b>{{$job->location}}</b></h5>
            <h3><b>Job Description</b></h3>
            <p>
                {{$job->description}}
            </p>
            <h4>Closing Date: {{$job->closing_date}}</h4>
            @if (Auth::user())
                <a href="#" class="btn btn-primary"><b>APPLY</b></a>
            @endif
        </div>
    </div>
@endsection