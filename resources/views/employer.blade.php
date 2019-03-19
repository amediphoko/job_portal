@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="companylogo" style="text-align:center; margin-top:1em">
                <img style="width:8em; height:8em" src="/storage/company_logos/{{Auth::user()->logo}}" alt="Logo" class="img-circle">
            </div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h3 style="text-align:center"><strong>{{Auth::user()->name}}</strong></h3>
                <ul style="list-style-type:none">
                    <li><i class="fa fa-map-marker"></i> Location: <br> {{Auth::user()->location}}</li>
                    <li><i class="fa fa-at"></i> Email: <br> {{Auth::user()->email}}</li>
                    <li><i class="fa fa-phone-square"></i> Contacts: <br> (+267) {{Auth::user()->contacts}}</li>
                    <li><i class="fa fa-industry"></i> Industry: <br> {{Auth::user()->industry}}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-wrap col-md-9">
        <button class="btn btn-primary pull-right">
            <i class="fa fa-plus">ADD A JOB</i>
        </button>
        <input type="radio" name="tabs" id="jobs-tab" checked>
        <div class="tab-label-content" id="jobs-content">
            <label for="jobs-tab"><i class="fa fa-suitcase"></i> Jobs Posted 
                <span class="badge pull-right">{{count($jobs)}}</span></label>
            <div class="tab-content">
                    @if (count($jobs) > 0)
                    <table class="table">
                        <thead style="background-color:#faf8f8cc">
                            <tr>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Salary</th>
                                <th>Qualification</th>
                                <th>Experience</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="padding:1em">
                        @foreach ($jobs as $job)
                            <a href="/jobs/{{$job->id}}">
                                <tr>
                                    <td>{{$job->title}}</td>
                                    <td>{{$job->location}}</td>
                                    <td>{{$job->category}}</td>
                                    <td>{{$job->type}}</td>
                                    <td>{{$job->salary}}</td>
                                    <td>{{$job->qualification}}</td>
                                    <td>{{$job->experience}}</td>
                                    <td>
                                        @if ($job->closing_date > Carbon\Carbon::now())
                                            <i class="fa fa-circle" style="color:#4ae00ece"></i> Open
                                        @else
                                        <i class="fa fa-circle" style="color:red"></i> Closed
                                        @endif
                                    </td>
                                </tr>
                            </a>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
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
                                <th>Applicant</th>
                                <th>Qualification</th>
                                <th>Documents</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                @if ($application->status == 'pending')
                                    <tr>
                                        <td>{{$application->id}}</td>
                                        <td>{{$application->job->title}}</td>
                                        <td>{{$application->user->name.' '.$application->user->last_name}}</td>
                                        <td>{{$application->user->qualification}}</td>
                                        <td><i class="fa fa-file-pdf-o"></i> {{$application->documents}}</td>
                                        <td>
                                            <a href=""><i class="fa fa-pencil-square-o"></i>review</a>
                                        </td>
                                        <td>
                                            <a href=""><i class="fa fa-list-alt"></i> shortlist</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach  
                        </tbody>
                    </table>
                @else
                    <p>No Applications made yet.</p>
                @endif
            </div>
        </div>
        <input type="radio" name="tabs" id="reviewed-tab">
        <div class="tab-label-content" id="reviewed-content">
            <label for="reviewed-tab"><i class="fa fa-pencil-square-o"></i> Reviewed</label>
            <div class="tab-content">
                TAB 3 - Reviewed
            </div>
        </div>
        <input type="radio" name="tabs" id="shortlist-tab">
        <div class="tab-label-content" id="shortlist-content">
            <label for="shortlist-tab"><i class="fa fa-list-alt"></i> Shortlist</label>
            <div class="tab-content">
                TAB 4 - Shortlist
            </div>
        </div>
        <div class="slide"></div>
    </div>
</div>
@endsection
