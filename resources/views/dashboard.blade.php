@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                        <li>Date of Birth: <br> {{Auth::user()->dob}}</li>
                        <li>Gender: <br> {{Auth::user()->gender}}</li>
                        <li>Email: <br> {{Auth::user()->email}}</li>
                        <li>Contact: <br> (+267) {{Auth::user()->contacts}}</li>
                        <li>Residence: <br> {{Auth::user()->residence}}</li>
                        <li>Qualification: <br> {{Auth::user()->qualification}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <ul id="userInfo" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#applications" id="applications-tab" role="tab" data-toggle="tab" aria-controls="applications" aria-expanded="true">Applications</a>
                </li>
                <li role="presentation" class="">
                    <a href="#messages" id="messages-tab" role="tab" data-toggle="tab" aria-controls="messages" aria-expanded="false">Messages</a>
                </li>
            </ul>
            <div id="userInfoContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="applications" aria-labelledby="applications-tab">
                    <p>Applications</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="messages" aria-labelledby="messages-tab">
                    <p>Messages</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
