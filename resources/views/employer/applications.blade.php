@extends('employer')

@section('subcontent')
    <div class="applications container">
        <h4 style="text-transform:capitalize">Manage {{$status}} Applications ({{count($applications)}})</h4><hr>
        <ul class="list-group list-group-flush">
            @if(count($applications) > 0)
                @foreach ($jobs as $job)
                    @if(count($job->applications) > 0)
                        <a href="/employer/applications/{{$status}}/{{$job->id}}" class="list-group-item"  style="border-radius:0">
                            <h4>
                                {{$job->title}}
                            </h4>
                            <p>{{count($job->applications)}} Applications</p>
                        </a>
                    @endif
                @endforeach
            @else
                <p style="text-align:center;padding:20px;">No {{$status}} applications.</p>
            @endif
        </ul>
    </div>
@endsection