@extends('layouts.app')

@section('content')
    <div class="row container-fluid">
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
                        <input type="text" class="form-control" id="title" name="title" value={{$title}}>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="location">Where ?</label>
                        <input type="text" class="form-control" id="location" name="location" value={{$location}}>
                    </div>
                </div>
                <button style="margin-top:2.2em"
                class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
            </form>
        </div>
        <div class="col-md-12 jobs" style="padding:1em; background-color:#fff;margin-top:10px">
            @if(count($data) > 0)
                <div class="col-md-2">
                    <label>Sort by </label>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
                            Category <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Category</a></li>
                            <li><a href="#">Type</a></li>
                            <li><a href="#">Company</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12" style="padding-top:1em; background-color:#fff">
                    <ul style="border-radius:none" class="list-group list-group-flush">
                        @foreach ($data as $result)
                            @if ($result->closing_date >= Carbon\Carbon::now())
                            <a href="/jobs/{{$result->id}}" class="list-group-item">
                                <img style="width:5em; padding-top:1em" src="/storage/company_logos/{{$result->employer->logo}}" alt="Logo" class="pull-left">
                                <div style="padding-left:1em" class="media-body">
                                    <h4>
                                        {{$result->title}}
                                        <span class="badge">{{$result->type}}</span>
                                    </h4>
                                    <i class="fa fa-calendar-times-o"></i><small> {{$result->closing_date}}</small>
                                    <i class="fa fa-briefcase"></i><small> {{$result->category}}</small>
                                    <i class="fa fa-map-marker"></i><small> {{$result->location}}</small>
                                    <p style="height:4em">
                                        {{ strip_tags($result->description) }}
                                    </p>
                                </div>
                            </a>
                            @endif
                        @endforeach
                        <small><b>End of search results.</b></small>
                    </ul>
                </div>
            @else
                <p style="text-align:center; padding:20px">No search results found matching your query.</p>
            @endif
        </div>
    </div>
@endsection