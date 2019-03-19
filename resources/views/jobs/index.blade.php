@extends('layouts.app')

@section('content')
    <div>
        
    </div>
    <div class="col-md-9">
        @if(count($jobs) > 0)
            <ul class="list-group list-group-flush">
                @foreach($jobs as $job)
                    @if ($job->closing_date > Carbon\Carbon::now())
                    <a href="/jobs/{{$job->id}}" class="list-group-item">
                        <img style="width:5em; padding-top:1em" src="/storage/company_logos/{{$job->employer->logo}}" alt="Logo" class="pull-left">
                        <div style="padding-left:1em" class="media-body">
                            <h4>
                                {{$job->title}}
                                <span class="badge">{{$job->type}}</span>
                            </h4>
                            <i class="fa fa-calendar-times-o"></i><small> {{$job->closing_date}}</small>
                            <i class="fa fa-briefcase"></i><small> {{$job->category}}</small>
                            <i class="fa fa-map-marker"></i><small> {{$job->location}}</small>
                            <p style="height:4em">
                                {{ strip_tags($job->description) }}
                            </p>
                        </div>
                    </a>
                    @endif
                @endforeach
            </ul>
        <div style="position:relative; left:50%">{{$jobs->links()}}</div>
        @else
            <p>No jobs found.</p>
        @endif
    </div>
    <div class="panel panel-default col-md-3">
        <div class="panel-heading">
            <h4 class="panel-title">Categories</h4>
        </div>
        <div class="panel-body">
            @if (count($jobs) > 0)
                <ul class="categories">
                    @foreach ($jobs as $job)
                        
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection