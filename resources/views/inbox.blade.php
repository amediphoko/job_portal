@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="userProfile" style="text-align:center; margin-top:1em">
                    <img style="width:9em; height:9em" src="/storage/profile_pictures/{{Auth::user()->pro_pic}}" alt="Logo" class="img-circle">
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 style="text-align:center"><strong>{{Auth::user()->name}} {{Auth::user()->last_name}}</strong></h3>
                    <ul style="list-style-type:none; marging:2em">
                        <li><i class="fa fa-calendar-o"></i> Date of Birth: <br> {{Auth::user()->dob}}</li>
                        <li>
                            @if (Auth::user()->gender == 'Female')
                                <i class="fa fa-female"></i> Gender: <br> {{Auth::user()->gender}}
                            @else
                            <i class="fa fa-male"></i> Gender: <br> {{Auth::user()->gender}}
                            @endif
                        </li>
                        <li><i class="fa fa-at"></i> Email: <br> {{Auth::user()->email}}</li>
                        <li><i class="fa fa-phone-square"></i> Contact: <br> (+267) {{Auth::user()->contacts}}</li>
                        <li><i class="fa fa-building"></i> Residence: <br> {{Auth::user()->residence}}</li>
                        <li><i class="fa fa-graduation-cap"></i> Qualification: <br> {{Auth::user()->qualification}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div style="padding-top:1em" class="col-lg-12 hd mail" id="showMessage">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="btn-toolbar" role="toolbar">
                            <div class="btn-group mr-1">
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-inbox"></i></button>
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-refresh"></i></button>
                                <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-trash-o"></i></button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="position-relative">
                            <div class="input-group search">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div> <!-- End row -->
                    <hr>
                <div class="card shadow-none mt-3 border border-light">
                    <div class="card-heading">
                        <h3>{{$inbox->subject}} <span style="background:#a9b5bd" class="badge badge-pill">Inbox</span></h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="media mb-3">
                            <div class="initial pull-left" id="initial">{{$inbox->employer->name[0]}}</div>
                            <div class="media-body">
                            <h4 class="m-0">{{ $inbox->employer->name }}</h4>
                                <small class="text-muted">
                                    <i class="fa fa-at"></i><a> {{ $inbox->employer->email }}</a><br>
                                    <?php
                                    $created = new Carbon\Carbon($inbox->created_at);
                                    $now = Carbon\Carbon::now();
                                    $difference = ($created->diff($now)->days < 1) ? 'today' : $created->diffForHumans($now);
                                    ?>
                                    {{$difference}}
                                </small>
                            </div>
                        </div> <!-- media -->
                        <div style="padding:1em" class="message">
                            {!! $inbox->message !!}
                        </div>
                        <hr>
                        <div class="footer">
                            <a href="/dashboard" class="back"><i class="fa fa-reply"></i> return to messages</a>
                        </div>
                    </div>
                </div> <!-- card -->
            </div>
        </div>
    </div>
@endsection