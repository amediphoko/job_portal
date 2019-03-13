@extends('layouts.app')

@section('content')
    <div class='row'>
        {{-- <div class='col-xs-6 col-md-offset-3'>
            <ul class="nav md-pills nav-justified pills-rounded pills-outline-red">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel89" role="tab">San Francisco <i class="far fa-grin ml-1"
                        aria-hidden="true"></i></a>
                </li>
            </ul>
        </div> --}}
        <div style="background-image:url({{asset('img/img.jpg')}}); background-repeat:no-repeat;
            background-size:cover; height:15em;  padding-top:1em">
            <h1 style="color:azure; text-align:center">Search for a Job</h1>
            <form class="form-inline" style="padding:10px; position:relative; left:30%">
                <div class="form-group">
                    <span class="icon"><i class="fa fa-search"></i></span>
                    <input type="text" id="search" class="form-control">
                </div>
                <div class="form-group">
                    <span class="icon"><i class="fa fa-location-arrow"></i></span>
                    <input type="text" class="form-control">
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
                <div class="list-group">
                    @foreach ($jobs as $job)
                        <a href="/jobs/{{$job->id}}" class="list-group-item">
                            <img src="">
                            <h4 class="list-group-item-heading">
                                {{$job->title}}
                            </h4>
                            <small>{{$job->closing_date}} | {{$job->category}} | {{$job->location}}</small>
                            <p class="list-group-item-text">
                                {{$job->description}}
                            </p>
                        </a>
                        <br>
                    @endforeach
                    <a href="/jobs" class="btn btn-default">BROWSE ALL JOBS</a>
                </div>         
            @endif
        </div>
    </div>
@endsection