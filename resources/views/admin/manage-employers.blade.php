@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card-mini">
            <div class="card-content">
                <div class="card-title">Employer Account Requests</div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if (count($employers) > 0)
                            <thead>
                                <th>#</th>
                                <th>Employer Name</th>
                                <th>Employer Email</th>
                                <th>Industry</th>
                                <th>Location</th>
                                <th>Contacts</th>
                                <th>Request Date</th>
                                <th></th>
                            </thead>
                            <?php $count = 1; ?>
                            <tbody>
                                @foreach ($employers as $employer)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$employer->name}}</td>
                                        <td>{{$employer->email}}</td>
                                        <td>{{$employer->industry}}</td>
                                        <td>{{$employer->location}}</td>
                                        <td>{{$employer->contacts}}</td>
                                        <td>{{$employer->created_at->toDateString()}}</td>
                                        <td>
                                            {!!Form::open(['action' => ['AdminController@acceptAccount', $employer->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('_method', 'PUT')}}
                                            <button style="color:red; background:transparent; border:none" data-toggle="tooltip" title="accept request" onclick="return confirm('You are accepting {{$employer->name}}\'s account request?')">
                                                <i class="fa fa-check"></i> Accept
                                            </button>
                                            {!!Form::close()!!}
                                            {!!Form::open(['action' => ['AdminController@destroy', $employer->id], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <button type="submit" style="color:mediumseagreen; background:transparent; border:none" data-toggle="tooltip" title="decline request" onclick="return confirm('Are you sure you want to decline {{$employer->name}}\'s account request?')">
                                                    <i class="fa fa-times"></i> Decline
                                                </button>
                                            {!!Form::close()!!}   
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
                            </tbody>
                        @else
                            <p>There Are Currently  No Account Requests.</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection