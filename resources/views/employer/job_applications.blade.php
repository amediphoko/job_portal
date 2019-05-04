@extends('employer')

@section('subcontent')
    <div class="container">
        <div class="send col-md-12" style="margin-bottom:10px">
            @if ($status == 'shortlisted')
                @include('employer.send_email')
            @endif
        </div>
        @if (count($job_applications) > 0)
            <table class="table table-hover table-striped" id="dt">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Applicant</th>
                        <th>Qualification</th>
                        <th>Documents</th>
                        <th>Added at</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($job_applications as $application)
                        @if ($application->status == 'pending')
                            <tr>
                                <td>{{$application->id}}</td>
                                <td>{{$application->user->name.' '.$application->user->last_name}}</td>
                                <td>{{$application->user->qualification}}</td>
                                <td>
                                        @foreach (json_decode($application->documents) as $document)
                                            <a href="/download/{{$document}}"><i style="color:red" class="fa fa-file-pdf-o"></i> {{ $document }}</a><br/>
                                        @endforeach
                                </td>
                                <td>{{$application->created_at->toDateString()}}</td>
                                <td>
                                    @include('inc.review')
                                </td>
                                <td>
                                    <a href="shortlist/{{$application->id}}" onclick="return confirm('You are adding'.$application->user->name.'to the shortlist, confirm')"><i class="fa fa-list-alt"></i> shortlist</a>
                                </td>
                            </tr> 
                        @elseif ($application->status == 'reviewed')
                            <tr>
                                <td>{{$application->id}}</td>
                                <td>{{$application->user->name.' '.$application->user->last_name}}</td>
                                <td>{{$application->user->qualification}}</td>
                                <td>
                                    @foreach (json_decode($application->documents) as $document)
                                        <a href="/download/{{$document}}"><i style="color:red" class="fa fa-file-pdf-o"></i> {{ $document }}</a><br/>
                                    @endforeach
                                </td>
                                <td>{{$application->created_at->toDateString()}}</td>
                                <td>
                                    <p><i class="fa fa-pencil-square-o"></i> reviewed</p>
                                </td>
                                <td>
                                    <a href="shortlist/{{$application->id}}" onclick="return confirm('You are adding {{$application->user->name}} to the shortlist, confirm')"><i class="fa fa-list-alt"></i> shortlist</a>
                                </td>
                            </tr>
                        @elseif ($application->status == 'shortlisted')
                            <tr>
                                <td>{{$application->id}}</td>
                                <td>{{$application->user->name.' '.$application->user->last_name}}</td>
                                <td>{{$application->user->qualification}}</td>
                                <td>
                                    @foreach (json_decode($application->documents) as $document)
                                        <a href="/download/{{$document}}"><i style="color:red" class="fa fa-file-pdf-o"></i> {{ $document }}</a><br/>
                                    @endforeach
                                </td>
                                <td>{{$application->created_at->toDateString()}}</td>
                                <td>
                                    <p><i class="fa fa-pencil-square-o"></i> reviewed</p>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @else
                            <p>No Shortlisted Applications.</p>
                        @endif
                    @endforeach  
                </tbody>
            </table>
        @endif
    </div>
@endsection