@extends('dashboard')

@section('subcontent')
    <div class="container">
        <div style="padding:2em" class="col-lg-12 hd mail" id="showMessage">
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
                        <a href="/dashboard/messages/{{$inbox->user->id}}" class="back"><i class="fa fa-reply"></i> return to messages</a>
                    </div>
                </div>
            </div> <!-- card -->
        </div>
    </div>
@endsection