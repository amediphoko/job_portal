<a data-toggle="modal" href="#myModal">
    <i class="fa fa-pencil-square-o"></i> review
</a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="text-align:center">Review Resumé</h4>
            </div>
            <!-- Body -->
            <div class="modal-body">
                <img style="width:5em" src="storage/profile_pictures/{{$application->user->pro_pic}}"/>
                <h5 style="border-bottom: 1px #cfcbcbcc solid; text-transform:uppercase">Applicant Bio</h5>
                <ul style="list-style:none">
                    <li><i class="fa fa-user"></i> <b>Name:</b> {{$application->user->name.' '.$application->user->last_name}}</li>
                    <li><i class="fa fa-at"></i> <b>Email:</b> {{$application->user->email}}</li>
                    <li><i class="fa fa-calendar"></i> <b>DOB:</b> {{$application->user->dob}}</li>
                    <li>
                        @if ($application->user->gender == 'Female')
                            <i class="fa fa-female"></i> <b>Gender:</b> {{$application->user->gender}}
                        @else
                        <i class="fa fa-male"></i> <b>Gender:</b> {{$application->user->gender}}
                        @endif
                    </li>
                    <li><i class="fa fa-phone-square"></i> <b>Mobile:</b> (+267) {{$application->user->contacts}}</li>
                    <li><i class="fa fa-graduation-cap"></i> <b>Degree Level:</b> {{$application->user->qualification}}</li>
                </ul>
                <h5 style="border-bottom: 1px #cfcbcbcc solid; text-transform:uppercase">Application Details</h5>
                <ul style="list-style:none">
                    <li><b>Job Title:</b> {{$application->job->title}}</li>
                    <li><b>Job Category:</b> {{$application->job->category}}</li>
                    <li><b>Job Type:</b> {{$application->job->type}}</li>
                    <li><i class="fa fa-download"></i> <b>Applicant Documents:</b><br />
                        @foreach (json_decode($application->documents) as $document)
                            <a href="/download/{{$document}}"><i style="color:red" class="fa fa-file-pdf-o"></i> {{ $document }}</a><br/>
                        @endforeach
                    </li>
                </ul>

            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <a href="review/{{$application->id}}" class="btn btn-default">Done</a>
                <a href="shortlist/{{$application->id}}" type="button" class="btn btn-primary" onclick="return confirm('You are adding'.$application->user->name.'to the shortlist, confirm')">Shortlist</a>
            </div>
        </div>
    </div>
</div>