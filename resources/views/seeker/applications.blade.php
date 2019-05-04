@extends('dashboard')

@section('subcontent')
    <div class="applications container">
        <h4>Manage Applications</h4><hr>
        @if (count($applications) > 0)
            <table id="applications" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Job Name</th>
                        <th scope="col">Employer</th>
                        <th scope="col">Category</th>
                        <th scope="col">Documents</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $application)
                        <tr>
                            <th scope="row">{{$application->id}}</th>
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
@endsection