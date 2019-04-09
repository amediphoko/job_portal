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
        <div class="tab-wrap col-md-9" id="users-tab">
            <input type="radio" name="tabs" id="applications-tab">
            <div class="tab-label-content" id="applications-content">
                <label for="applications-tab"><i class="fa fa-clipboard"></i> Applications 
                    <span class="badge pull-right">{{count($applications)}}</span></label>
                <div class="tab-content">
                    @if (count($applications) > 0)
                        <table class="table">
                            <thead style="background-color:#faf8f8cc">
                                <tr>
                                    <th>ID</th>
                                    <th>Job Name</th>
                                    <th>Employer</th>
                                    <th>Category</th>
                                    <th>Documents</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>{{$application->id}}</td>
                                        <td>{{$application->job->title}}</td>
                                        <td>{{$application->employer->name}}</td>
                                        <td>{{$application->job->category}}</td>
                                        <td>
                                            @foreach (json_decode($application->documents) as $document)
                                                <a href="/download/{{$document}}"><i style="color:red" class="fa fa-file-pdf-o"></i> {{ $document }}</a><br/>
                                            @endforeach
                                        </td>
                                        <td><i class="fa fa-exclamation-circle"></i> {{ $application->status }}</td>
                                        <td>
                                            {!!Form::open(['action' => ['ApplicationsController@destroy', $application->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <i style="color:red" class="fa fa-trash">
                                                {{Form::submit(' Delete', ['style' => 'background-color:transparent; border:none; color:red; font-style:sans-serif', 'data-toggle' => 'tooltip', 'data-original-title' => 'Delete Application', 'onclick' => 'return confirm(\'Are you sure you want to delete?\')'])}}
                                                </i>
                                            {!!Form::close()!!}
                                        </td>
                                    </tr>
                                @endforeach  
                            </tbody>
                        </table>
                    @else
                        <p>No Applications made yet.</p>
                    @endif
                </div>
            </div>
            <input type="radio" name="tabs" id="messages-tab" checked>
            <div class="tab-label-content" id="messages-content">
                <label for="messages-tab"><i class="fa fa-envelope"></i> Messages 
                    <span class="badge pull-right">{{count($inboxes)}}</span></label>
                <div class="tab-content inbox">
                    
                    {{-- INBOX THINGY --}}
                    <div class="container-fluid" id="hideThis">
                        <div class="row clearfix">
                            <div class="col-lg-12 hd">
                                <div class="card action_bar">
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-lg-1 col-md-2 col-3">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                       <i class="fa fa-filter"></i> Filter <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="/dashboard">All</a></li>
                                                        <li><a href="/dashboard?status=read">Read</a></li>
                                                        <li><a href="/dashboard?status=unread">Unread</a></li>
                                                    </ul>
                                                </div>                               
                                            </div>
                                            <div style="margin-left:20px" class="col-lg-1 col-md-2 col-3">
                                                <button class="btn btn-default btn-sm tooltips" type="button" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                            <div class="col-lg-5 col-md-4 col-6">   
                                                <form action="{{url('inbox_search')}}" method="GET" class="form-inline">
                                                    <div class="form-group">
                                                        <input type="text" name="searchterm" class="form-control" placeholder="Search...">
                                                    </div>
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </form> 
                                            </div>                                                     
                                        </div>
                                    </div>
                                </div>
                            </div>         
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-email">
                                @if (count($inboxes) > 0)
                                <tbody>
                                    @foreach ($inboxes as $inbox)
                                    <tr class="{{$inbox->status}} clickable-row" data-href="/dashboard/{{$inbox->id}}" >
                                            <td>
                                                <div class="ckbox ckbox-theme">
                                                    <input id="ck_{{$inbox->id}}" type="checkbox" name="inbox[]" value="{{$inbox->id}}" class="mail-checkbox">
                                                    <label for="ck_{{$inbox->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <div class="pull-left">
                                                        <img alt="..." src="/storage/company_logos/{{$inbox->employer->logo}}" class="media-object">
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-primary">{{$inbox->employer->name}}</p>
                                                        <small class="pull-right text-muted"><time class="hidden-sm-down" datetime="2017">12:35 AM</time></small>
                                                        <p class="subject">{{$inbox->subject}}</p>
                                                        <p class="email-summary">
                                                            {{strip_tags($inbox->message)}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @else
                                    <div>
                                        <p style="text-align:center"><b>No Messages.</b></p>
                                    </div>
                                @endif
                            </table>
                            <div class="card m-t-5">
                                <div class="body" style="text-align:center">
                                    {{$inboxes->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- END OF INBOX THINGY --}}
                </div>
            </div>
            <div class="slide"></div>
        </div>
    </div>
</div>
@endsection
