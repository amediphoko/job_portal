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
@endsection
