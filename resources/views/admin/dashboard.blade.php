@extends('layouts.app')

@section('content')
<div class="container col-md-9" style="padding-left:3em; padding-top:1em">
    <div class="row">
        <div class="col-md-9">
            <h3>Dashboard <small>ITJOMS</small></h3>
        </div>
        <div class="col-md-3" style="padding-top:1em">
            <h5><i class="fa fa-home"></i> Home > Dashboard</h5>
        </div>
    </div>
    <div class="row">
        <div class="row stats-card col-md-4">
            <div class="card-content">
                <span style="color:#25586d" class="fa fa-users col-md-2"></span>
                <h4 class="col-md-9">Accounts Requests <br> <b>{{count($requests)}}<b></h4>
            </div>
        </div>
        <div class="row stats-card col-md-4">
            <div class="card-content">
                <span style="color:#6134a8" class="fa fa-comment-o col-md-2"></span>
                <h4 class="col-md-9">Posts Requests <br> <b>{{count($posts)}}<b></h4>
            </div>
        </div>
        <div class="row stats-card col-md-4">
            <div class="card-content">
                <span style="color:#57b8b8" class="fa fa-list-ol col-md-2"></span>
                <h4 class="col-md-9">Total Accounts <br> <b>{{count($employers)}}<b></h4>
            </div>
        </div>
    </div>
    
    <div class="row card-mini">
        <div class="card-content">
            <div class="card-title">Active Employer Accounts 
                <span class="badge" style="background:mediumseagreen">{{count($active_employers)}}</span>
            </div>
            <div class="table-responsive">
                <table style="font-weight:100" class="table table-hover">
                    @if (count($active_employers) > 0)
                        <thead>
                            <th>#</th>
                            <th>Employer Name</th>
                            <th>Employer Email</th>
                            <th>Industry</th>
                            <th>Location</th>
                            <th>Contacts</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <?php $count = 1; ?>
                        <tbody>
                            @foreach ($active_employers as $active)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$active->name}}</td>
                                    <td>{{$active->email}}</td>
                                    <td>{{$active->industry}}</td>
                                    <td>{{$active->location}}</td>
                                    <td>{{$active->contacts}}</td>
                                    <td> <i class="fa fa-circle" style="color:mediumseagreen"></i> active</td>
                                    <td>
                                          
                                    </td>
                                </tr>
                                <?php $count++; ?>
                            @endforeach
                        </tbody>
                    @else
                        <p>There Are Currently No Active Accounts.</p>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection