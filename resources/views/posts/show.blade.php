@extends('layouts.app')

@section('content')
    <div class="col-lg-8"style="background:white; margin-top:2em">
        <h1 class="mt-4">{{$post->title}}</h1>
        <p class="lead">
            by
            <a href="#">{{$post->employer->name}}</a>
        </p>
        <hr>
        <p>Posted {{$post->created_at->diffForHumans()}}</p>
        <hr>
        <p class="lead">{!! $post->body !!}</p>
        <hr>
        @if (Auth::guard('web')->check())
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            {{Form::textarea('comment', '', ['rows' => '3', 'class' => 'form-control'])}}
                        </div>
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        @endif
            <br>
        @if (count($post->comments) > 0)
            <button type="button" class="btn btn-default col-md-12" style="border-radius:0" data-toggle="collapse" data-target="#demo">
                <span style="font-size:1.4em" class="fa fa-comments"></span> Comments <span style="background:cadetblue" class="badge">{{count($post->comments)}}</span>
            </button>
            @foreach ($post->comments as $comment)
            <br>
            <div id="demo" class="collapse out" style="padding-top:3em">
                <div class="row col-md-offset-1">
                    <div class="col-sm-2 text-center">
                        <img src="/storage/profile_pictures/{{$comment->user->pro_pic}}" class="img-circle" height="65" width="65" alt="Avatar">
                    </div>
                    <div class="col-sm-10">
                        <h4>{{$comment->user->name}} {{$comment->user->last_name}} <small>{{$comment->created_at}}</small></h4>
                        <p>{{$comment->comment}}</p>
                        <br>
                    </div>
                    
                </div>
            </div>
            @endforeach
        @endif          
    </div>
    <div class="col-md-4" style="padding-top:2em">
        <div style="border-radius:0" class="panel panel-default">
            <div class="panel-heading" style="background:#ebeaea">
                <h4 class="panel-title">Related News</h4>
            </div>
            <ul class="panel-body list-group">
                <a class="list-group-item" href=""><i class="fa fa-angle-right"></i> something
                    <span style="background:blue" class="badge"></span>
                </a>
            </ul>
        </div>
    </div>
@endsection