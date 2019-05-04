@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card-mini">
            <div class="card-content">
                <div class="card-title">Post Requests</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if (count($posts) > 0)
                            <thead>
                                <th>#</th>
                                <th>Employer Name</th>
                                <th>Title</th>
                                <th>Post Content</th>
                                <th>Date Requested</th>
                                <th></th>
                            </thead>
                            <?php $count = 1; ?>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$post->employer->name}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{strip_tags($post->body)}}</td>
                                        <td>{{$post->created_at->toDateString()}}</td>
                                        <td>
                                            {!!Form::open(['action' => ['AdminController@acceptPost', $post->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                <button style="color:red; background:transparent; border:none" data-toggle="tooltip" title="accept request" onclick="return confirm('You are approving {{$post->title}} post?')">
                                                    <i class="fa fa-check"></i> Approve
                                                </button>
                                            {!!Form::close()!!}
                                            <br>
                                            {!!Form::open(['action' => ['AdminController@delete_post', $post->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <button type="submit" style="color:mediumseagreen; background:transparent; border:none" data-toggle="tooltip" title="decline request" onclick="return confirm('Are you sure you want to decline {{$post->title}} post?')">
                                                    <i class="fa fa-times"></i> Decline
                                                </button>
                                            {!!Form::close()!!}   
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are Currently No Post Requests.</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection