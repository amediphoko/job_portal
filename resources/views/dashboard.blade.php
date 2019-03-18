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
            <input type="radio" name="tabs" id="applications-tab" checked>
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
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>{{$application->id}}</td>
                                        <td>{{$application->job->title}}</td>
                                        <td>{{$application->employer->name}}</td>
                                        <td>{{$application->job->category}}</td>
                                        <td><i class="fa fa-file-pdf-o"></i> {{$application->documents}}</td>
                                        <td><i class="fa fa-exclamation-circle"></i> {{ $application->status }}</td>
                                        <td><a href="#"><i style="color:red; font-size:1.5em" class="fa fa-times-circle"></i></a></td>
                                    </tr>
                                @endforeach  
                            </tbody>
                        </table>
                    @else
                        <p>No Applications made yet.</p>
                    @endif
                </div>
            </div>
            <input type="radio" name="tabs" id="messages-tab">
            <div class="tab-label-content" id="messages-content">
                <label for="messages-tab"><i class="fa fa-envelope"></i> Messages</label>
                <div class="tab-content">
                    TAB 2 - Fusce pellentesque nunc nec arcu feugiat accumsan.
                    Praesent mauris sem, eleifend sit amet tortor in, cursus vehicula arcu.
                    Curabitur convallis sit amet nunc ac feugiat. Sed at risus id diam porta pretium id vel felis.
                    Donec nec dui id nisl hendrerit laoreet eu id odio.
                </div>
            </div>
            <div class="slide"></div>
        </div>
    </div>
</div>
@endsection
