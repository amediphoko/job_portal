@extends('layouts.app')

@section('content')

<div class="main-header">
    <div class="profile-image col-md-3">
        {!! Form::open(['action' => ['DashboardController@img_update', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
            <input type="file" name="pro_pic" id="pro_pic">
            <label id="output" for="pro_pic" style="background:url(/storage/profile_pictures/{{Auth::user()->pro_pic}}); background-size:cover; background-repeat:no-repeat">
                <i class="fa fa-camera-retro"> 
                    Change Image
                </i>
            </label>
            {{Form::hidden('_method', 'PUT')}}
            <button type="submit" name="upload" class="tooltips" id="upload" data-toggle="tooltip" data-container="body" title="" data-original-title="Upload">
                <i class="fa fa-check"></i>
            </button>
        {!! Form::close() !!}
    </div>
    <div class="profile-details col-md-8">
        <h2><i class="fa fa-user"></i><strong> {{Auth::user()->name}} {{Auth::user()->last_name}}</strong></h2>
        <div class="col-md-4">
            <p><i class="fa fa-at"></i> Email: {{Auth::user()->email}}</p>
            <p><i class="fa fa-phone-square"></i> Contact: (+267) {{Auth::user()->contacts}}</p>
            <p><i class="fa fa-building"></i> Residence: {{Auth::user()->residence}}</p>
        </div>
        <div class="col-md-4">
                @if (Auth::user()->gender == 'Female')
                    <p><i class="fa fa-female"></i> Gender: {{Auth::user()->gender}}</p>
                @else
                    <p><i class="fa fa-male"></i> Gender: {{Auth::user()->gender}}</p>
                @endif
                <p><i class="fa fa-calendar"></i> Date of Birth: {{Auth::user()->dob}}</p>
                <p><i class="fa fa-graduation-cap"></i> Qualification: {{Auth::user()->qualification}}</p>
        </div>
        <h5><i class="fa fa-home"></i> My Dashboard</h5>
    </div>
</div>
<div class="sub-nav container">
    <nav class="navbar navbar-default" role="navigation">
        <ul class="nav navbar-nav">
            <li class="active"><a href="/dashboard/applications/{{Auth::user()->id}}"><i class="fa fa-clipboard"></i> My Applications</a></li>
            <li><a href="/dashboard/messages/{{Auth::user()->id}}"><i class="fa fa-envelope"></i> Messages</a></li>
            <li><a href="/dashboard/profile"><i class="fa fa-cogs"></i> My Profile</a></li>
            <li><a href="/dashboard/coverinfo/{{Auth::user()->id}}"><i class="fa fa-folder-open"></i> Documents</a></li>
        </ul>
    </nav>
</div>
<div class="content-info">
    @yield('subcontent')
</div>

{{-- <div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                {!! Form::open(['action' => ['DashboardController@img_update', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                    <input type="file" name="pro_pic" id="pro_pic">
                    <label id="output" for="pro_pic" style="background:url(/storage/profile_pictures/{{Auth::user()->pro_pic}}); background-size:cover; background-repeat:no-repeat">
                        <i class="fa fa-camera-retro"> 
                            Change Image
                        </i>
                    </label>
                    {{Form::hidden('_method', 'PUT')}}
                    <button type="submit" name="upload" class="tooltips" id="upload" data-toggle="tooltip" data-container="body" title="" data-original-title="Upload">
                        <i class="fa fa-check"></i>
                    </button>
                {!! Form::close() !!}
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('inc.profile-edit')
                    <br>
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
            <form action="">
                <div class="form-group">
                    <label for="name">Your interests : </label>
                    <select multiple class="form-control">
                       @if (count($categories) > 0)
                            @foreach ($categories as $category)
                                <option value={{$category}}>{{$category}}</option>
                            @endforeach
                       @endif
                    </select>
                    <span class="help-block">Let us know your interests to help make your job search easier us.</span>
                </div>   
            </form>
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
                    
                    INBOX THINGY
                    <div class="container-fluid" id="hideThis">
                        <div class="row clearfix">
                            <div class="col-lg-12 hd">
                                <div class="card action_bar">
                                    <div class="body">
                                        <div class="row clearfix">                    
                                                                                             
                                        </div>
                                    </div>
                                </div>
                            </div>         
                        </div>
                        <div class="table-responsive">
                            <div style="color:black;font-weight:600;padding:8px;" class="col-lg-1 col-md-2 col-3">
                                <input class="col-md-6" type="checkbox" name="all[]" id="all">
                                All
                            </div>
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
                            <div class="col-lg-6 col-md-4 col-6 pull-right">   
                                <form action="{{url('inbox_search')}}" method="GET" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="searchterm" class="form-control" placeholder="Search...">
                                    </div>
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form> 
                            </div>  
                            <form action="{{ url('delete_msg') }}" method="POST">
                                {{ csrf_field() }}
                                <div style="margin-left:20px" class="col-lg-1 col-md-2 col-3">
                                    <button class="btn btn-default btn-sm tooltips" type="submit" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete" onclick ="return confirm('Are you sure you want to delete?')">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </div>
                                <table class="table table-hover table-email">
                                    @if (count($inboxes) > 0)
                                    <tbody>       
                                        @foreach ($inboxes as $inbox)
                                        <tr class="{{$inbox->status}} clickable-row" data-href="/dashboard/{{$inbox->id}}" >
                                                <td> 
                                                    <div class="ckbox ckbox-theme">
                                                        <input id="{{$inbox->id}}" type="checkbox" name="inbox[]" value="{{$inbox->id}}" class="mail-checkbox">
                                                        <label for="{{$inbox->id}}"></label>
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
                                        <div class="col-md-12">
                                            <p style="text-align:center;padding:30px"><b>No Messages.</b></p>
                                        </div>
                                    @endif
                                </table>
                            </form>
                            @if (count($inboxes) > 0)
                                <div class="card m-t-5">
                                    <div class="body" style="text-align:center">
                                        {{$inboxes->links()}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    END OF INBOX THINGY
                </div>
            </div>
            <div class="slide"></div>
        </div>
    </div>
</div> --}}
@endsection
