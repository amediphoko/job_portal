@extends('layouts.app')
<style>
    .panel .panel-body a:active {
        color:brown;
    }
</style>

@section('content')
    <div class="col-md-12 search-pane">
        <h1 style="text-align:center; font-weight:100; font-size:4em; color:#ececec">
            <i style="color:gray" class="fa fa-search"></i> Search</h1>
        <p style="text-align:center; font-weight:100; font-size:20px; color:#fff">Begin search for your desired job now.</p>
    </div>
    <div class="col-md-12 jobsearch" style="padding-top:2em; padding-bottom:1em; background-color:#fff; margin-top:10px">
        <form action="{{url('search')}}" class="col-md-offset-2" method="GET" role="search" id="search">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-md-4">
                    <label for="title">What are you looking for ?</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$title}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label for="location">Where ?</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{$location}}">
                </div>
            </div>
            <button style="margin-top:2.2em"
            class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
        </form>
    </div>
    <div class="col-md-12 jobs" style="padding:1em; background-color:#fff;margin-top:10px">
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
                <p style="text-align:center; padding:20px">No query results found matching your request.</p>
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
    </div>
@endsection