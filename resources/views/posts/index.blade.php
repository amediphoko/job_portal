@extends('layouts.app')
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {
            height: 1500px;
            padding-top: 1em;
        }
        
        /* Set black background color, white text and some padding */
        footer {
        background-color: #555;
        color: white;
        padding: 15px;
        }
        
        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
        .row.content {height: auto;} 
        }
  </style>

@section('content')
    <div class="col-md-12 news-pane">
        <h1 style="text-align:center; font-weight:100; font-size:4em; color:#ececec">
            News Forum
        </h1>
        <p style="text-align:center; font-weight:100; font-size:20px; color:#fff">More on the latest local information technology news.</p>
        @if (Auth::guard('employer')->check())
            <button style="margin-bottom:10px" type="button" class="btn btn-primary pull-right" data-toggle="collapse" data-target="#demo">
                <span class="glyphicon glyphicon-plus"></span> Add New Post
            </button>
        @endif
    </div>
    @if (Auth::guard('employer')->check())
        <div id="demo" class="collapse out" >
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
                <br>
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                </div>
                <div class="form-group">
                    @if (count($categories) > 0)
                        <strong>Tags : </strong>
                        @foreach ($categories as $category)
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tags[]" value="{{$category}}"> {{$category}}
                            </label>
                        @endforeach
                    @endif
                </div>
                {{Form::submit('Add Post', ['class' => 'btn btn-success'])}}
            {!! Form::close() !!}
        </div>
    @endif
    <div class="col-md-12 content" style="background-color:#fff;margin-top:10px">
        <hr>
        <div class="col-sm-9">
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <h4>{{$post->title}}</h4>
                    <h5><span class="glyphicon glyphicon-time"></span> Post by <strong>{{$post->employer->name}}</strong>, <small>{{$post->created_at->diffForHumans()}}</small></h5>
                    <h5 id="tags"> 
                        @if (count(json_decode($post->tags)) > 0)
                            @foreach (json_decode($post->tags) as $tag)
                                <span class="label">{{$tag}}</span>
                            @endforeach
                        @endif
                    </h5>
                    <p style="height:5em;overflow:hidden">{{strip_tags($post->body)}}</p>
                    <a href="/posts/{{$post->id}}" class="btn btn-primary pull-right">Read more <i class="fa fa-angle-double-right"></i> </a>
                    <br><hr>
                @endforeach
                <div style="margin-left:50%">
                    {{$posts->links()}}
                </div>     
            @endif
        </div>
    </div>  
@endsection