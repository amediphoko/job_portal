@extends('layouts.app')

@section('content')
    <div class="col-md-9">
        @if(count($jobs) > 0)
            <ul class="list-group list-group-flush">
                @foreach($jobs as $job)
                    <a href="/jobs/{{$job->id}}" class="list-group-item">
                        <img style="width:5em" src="/storage/company_logos/{{$job->employer->logo}}" alt="Logo" class="img-circle">
                        <h4>
                            {{$job->title}}
                            <span class="badge">{{$job->type}}</span>
                        </h4>
                        <small>{{$job->closing_date}} | {{$job->category}} | {{$job->location}}</small>
                        <p>
                            {{$job->description}}
                        </p>
                    </a>
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