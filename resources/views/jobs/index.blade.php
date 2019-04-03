@extends('layouts.app')
<style>
    .panel .panel-body a:active {
        color:brown;
    }
</style>

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/jobs">Jobs</a></li>
    </ol>
    <div class="col-md-9">
        @if(count($jobs) > 0)
            <ul class="list-group list-group-flush">
                @foreach($jobs as $job)
                    @if ($job->closing_date >= Carbon\Carbon::now())
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
    <div class="col-md-3">
        <div class="panel panel-default">
            <ul class="panel-body">
                <a href="/jobs" class="list-group-item"><i class="fa fa-angle-right"></i> All
                    <span style="background:blue" class="badge">{{count($jobs_all->where('closing_date', '>=', Carbon\Carbon::now()))}}</span>
                </a>
            </ul>
        </div>
        <div class="panel panel-default" id="categories">
            <div class="panel-heading" style="background:#ebeaea">
                <h4 class="panel-title">Categories</h4>
            </div>
            @if (count($categories) > 0)
                <ul class=" panel-body list-group">
                    @foreach ($categories as $category)
                        <a class="list-group-item" href="/jobs?category={{$category}}"><i class="fa fa-angle-right"></i> {{$category}}
                            <span style="background:blue" class="badge">{{count($jobs_all->where('category', '=', $category))}}</span>
                        </a>
                     @endforeach
                </ul>
            @endif
        </div>
        <div class="panel panel-default" id="types">
            <div class="panel-heading" style="background:#ebeaea">
                <h4 class="panel-title">Types</h4>
            </div>
            @if (count($types) > 0)
                <ul class=" panel-body list-group">
                    @foreach ($types as $type)
                        <a class="list-group-item" href="/jobs?type={{$type}}"><i class="fa fa-angle-right"></i> {{$type}}
                            <span style="background:blue" class="badge">{{count($jobs_all->where('type', '=', $type))}}</span>
                        </a>
                        @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection