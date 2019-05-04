@extends('employer')

@section('subcontent')
<div class="jobs-posted container">
    <h4>Posted Jobs ({{count($jobs)}})</h4><hr>
    @if (count($jobs) > 0)
        <table class="table table-hover table-striped" id="dt">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Salary</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="padding:1em;">
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
                        <td>
                            <a href="/jobs/{{$job->id}}"><i class="fa fa-eye"></i> View</a> <br>
                            <a href="/jobs/{{$job->id}}/edit"><i class="fa fa-edit"></i> Edit</a> <br>
                            {!!Form::open(['action' => ['JobsController@destroy', $job->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                            <i style="color:red" class="fa fa-trash">
                                {{Form::submit(' Delete', ['style' => 'background-color:transparent; border:none; color:red; font-style:sans-serif', 'onclick' => 'return confirm(\'Are you sure you want to delete?\')'])}}
                            </i>
                            {!!Form::close()!!}
                        </td>
                    </tr>
                </a>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection