@extends('layouts.app')

@section('content')
    <div class="home" style="height:13em;padding-top:1em">
        <h1 style="color:azure; text-align:center">Search for a Job</h1>
        <form action="{{url('search')}}" method="GET" class="form-inline" style="padding:10px;margin-left:30%">
            <div class="input-group input-group-md">
                <span class="input-group-addon">
                    <span class="fa fa-text-height"></span>  
                </span>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="input-group input-group-md">
                <span class="input-group-addon">
                    <span class="fa fa-map-marker"></span>  
                </span>
                <input type="text" name="location" id="location" class="form-control">
            </div>
            <button type="submit" class="btn btn-default">
                <i class="fa fa-search"></i> Search</button>
        </form>
    </div>
    <div class="col-md-12">
        <h2 style="text-align:center">Welcome to the IT JOMS Portal</h2>
        <hr style="width:20em;border:1px solid #b3c8dd">
        <p style="text-align:center;padding-left:80px;padding-right:80px">
            IT JOMS is an Information Technology Job Opportunities Management System, 
            the system enables jobseekers looking for jobs to register themselves with the website, 
            look up for different jobs according to their qualifications and apply for those jobs.
            On the other hand, employers can register to this portal and post job vacancies which 
            would enable them to find the suitable applicants for their vacant positions.
        </p>
    </div>
    <div class="col-md-12 latest-news">
        <h2 style="text-align:center">Latest News</h2>
        <hr style="width:8em;border:1px solid #b3c8dd">
        @if (count($posts) > 0)
            <ul class="list-group list-group-flush">
                @foreach ($posts as $post)
                    <a href="/posts/{{$post->id}}" class="list-group-item">
                        <h4>
                            {{$post->title}}
                        </h4>
                        <h5><span class="glyphicon glyphicon-time"></span> Post by <strong>{{$post->employer->name}}</strong>, <small>{{$post->created_at->diffForHumans()}}</small></h5>
                        <h5 id="tags"> 
                            @if (count(json_decode($post->tags)) > 0)
                                @foreach (json_decode($post->tags) as $tag)
                                    <span class="label">{{$tag}}</span>
                                @endforeach
                            @endif
                        </h5>
                        <p style="height:5em;overflow:hidden">{{strip_tags($post->body)}}</p>
                    </a>
                @endforeach
                <br>
                <a href="/posts" class="btn btn-default">
                    BROWSE ALL NEWS <i class="fa fa-angle-double-right"></i>
                </a>
            </ul>         
        @endif
    </div>
@endsection