@extends('layouts.app')

@section('content')
<div class="container">
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
                    <ul style="list-style-type:none; marging:2em">
                        <li>Location: <br> {{Auth::user()->location}}</li>
                        <li>Email: <br> {{Auth::user()->email}}</li>
                        <li>Contacts: <br> (+267) {{Auth::user()->contacts}}</li>
                        <li>Industry: <br> {{Auth::user()->industry}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <a href="/jobs/create" class="btn btn-primary pull-right">ADD JOB</a>
            <ul id="employerInfo" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#jobs" id="jobs-tab" role="tab" data-toggle="tab" aria-controls="jobs" aria-expanded="true">Jobs Posted</a>
                </li>
                <li role="presentation" class="">
                    <a href="#applications" id="applications-tab" role="tab" data-toggle="tab" aria-controls="applications" aria-expanded="false">Applications</a>
                </li>
                <li role="presentation" class="">
                    <a href="#reviewed" id="reviewed-tab" role="tab" data-toggle="tab" aria-controls="reviewed" aria-expanded="false">Reviewed</a>
                </li>
                <li role="presentation" class="">
                    <a href="#shortlist" id="shortlist-tab" role="tab" data-toggle="tab" aria-controls="shortlist" aria-expanded="false">Shortlist</a>
                </li>
            </ul>
            <div id="employerInfoContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="jobs" aria-labelledby="jobs-tab">
                    @if (count($jobs) > 0)
                        <table class="table table-striped">
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
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{$job->title}}</td>
                                    <td>{{$job->location}}</td>
                                    <td>{{$job->category}}</td>
                                    <td>{{$job->type}}</td>
                                    <td>{{$job->salary}}</td>
                                    <td>{{$job->qualification}}</td>
                                    <td>{{$job->experience}}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane fade" id="applications" aria-labelledby="applications-tab">
                    <p>Applications List</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="reviewed" aria-labelledby="reviewed-tab">
                    <p>Applications Reviewed List</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="shortlist" aria-labelledby="shortlist-tab">
                    <p>Shortlisted Applicants</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
