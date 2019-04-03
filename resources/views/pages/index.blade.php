@extends('layouts.app')

@section('content')
    <div class='row'>
        <div style="background-image:url({{asset('img/img.jpg')}}); background-repeat:no-repeat;
            background-size:cover; height:15em;  padding-top:1em">
            <h1 style="color:azure; text-align:center">Search for a Job</h1>
            <form action="{{url('search')}}" method="GET" class="form-inline" style="padding:10px; position:relative; left:30%">
                <div class="form-group">
                    <span class="icon"><i class="fa fa-search"></i></span>
                    <input type="text" id="title" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <span class="icon"><i class="fa fa-map-marker"></i></span>
                    <input type="text" id="location" name="location" class="form-control">
                </div>
                <button type="submit" class="btn btn-default">FIND</button>
            </form>
        </div>
        <div class="col-md-12" style="padding:10px">
            <h1 style="text-align:center">Welcome to the IT JOMS Portal</h1><hr>
            <p>IT JOMS is an Information Technology Job Opportunities Management, the system enables
                jobseekers looking for jobs to register themselves with the website, look up for different
                jobs according to their qualifications and apply for those jobs..</p>
            <a href="#">Learn more about us</a>
        </div>
        <div class="col-md-12" style="padding:5px">
            <h1 style="text-align:center">Available Jobs</h1>
            <hr>
            @if (count($jobs) > 0)
                <ul class="list-group list-group-flush">
                    @foreach ($jobs as $job)
                        <a href="/jobs/{{$job->id}}" class="list-group-item">
                            <img src="">
                            <h4>
                                {{$job->title}}
                            </h4>
                            <i class="fa fa-calendar-times-o"></i><small> {{$job->closing_date}}</small>
                            <i class="fa fa-suitcase"></i><small> {{$job->category}}</small>
                            <i class="fa fa-map-marker"></i><small> {{$job->location}}</small>
                            <p style="height:2em">
                                {{ strip_tags($job->description) }}
                            </p>
                        </a>
                    @endforeach
                    <br>
                    <a href="/jobs" class="btn btn-default">BROWSE ALL JOBS</a>
                </ul>         
            @endif
        </div>
    </div>
@endsection