@extends('layouts.app')

@section('content')
<div class="main-header">
    <div class="profile-image col-md-3">
        {!! Form::open(['action' => ['EmployerController@logo_update', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
            <input type="file" name="logo" id="pro_pic">
            <label id="output" for="pro_pic" style="background:url(/storage/company_logos/{{Auth::user()->logo}}); background-size:cover; background-repeat:no-repeat">
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
        <h2><i class="fa fa-briefcase"></i><strong> {{Auth::user()->name}}</strong></h2>
        <div class="col-md-4">
            <p><i class="fa fa-at"></i> Email: {{Auth::user()->email}}</p>
            <p><i class="fa fa-phone-square"></i> Contact: (+267) {{Auth::user()->contacts}}</p>
        </div>
        <div class="col-md-4">
            <p><i class="fa fa-building"></i> Location: {{Auth::user()->location}}</p>
            <p><i class="fa fa-industry"></i> Industry: {{Auth::user()->industry}}</p>
        </div>
        <div style="position:relative;top:-50px;left:40px" class="col-md-2 pull-right">
            <a href="/jobs/create" class="btn btn-success pull-right">
                <i class="fa fa-plus"></i> ADD A JOB
            </a>
        </div>
    </div>
</div>
<div class="sub-nav container">
    <nav class="navbar navbar-default" role="navigation">
        <ul class="nav navbar-nav">
            <li class="active"><a href="/employer/jobs_posted/{{Auth::user()->id}}"><i class="fa fa-suitcase"></i> Jobs Posted</a></li>
            <li><a href="/employer/applications/1"><i class="fa fa-clipboard"></i> Pending</a></li>
            <li><a href="/employer/applications/2"><i class="fa fa-pencil-square-o"></i> Reviewed</a></li>
            <li><a href="/employer/applications/3"><i class="fa fa-file"></i> Shortlisted</a></li>
            <li><a href="/employer/profile"><i class="fa fa-cogs"></i> My Profile</a></li>
        </ul>
    </nav>
</div>
<div class="content-info">
    @yield('subcontent')
</div>
@endsection
