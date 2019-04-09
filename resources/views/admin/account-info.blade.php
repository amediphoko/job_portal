@extends('layouts.app')

@section('content')
    <div class="container col-md-9" style="padding-left:3em; padding-top:1em">
        <div class="row card-mini">
            <div class="card-content">
                <div class="card-title">Administrator Account Settings</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Admin Information</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class=" fa fa-user"></i> <b>Name :</b> {{$admin->name}}
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-at"></i> <b>Email :</b> {{$admin->email}}
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-calendar"></i> <b>Creation Date :</b> {{$admin->created_at}}
                            </li>
                        </ul>
                    </div>
                    <div class="panel-heading">
                        <h3 class="panel-title">Change Password</h3>
                    </div>
                    <div class="panel-body" style="padding-top:20px">
                        {!! Form::open(['action' => 'AdminController@change_password', 'method' => 'POST']) !!}
                            {{ csrf_field() }}
                            
                            <input type="text" name="oldpassword" value="{{$admin->password}}" hidden>

                            <div class="col-md-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-7 control-label">Current Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autofocus>
                            </div>

                            <div class="col-md-4 form-group"{{ $errors->has('newpassword') ? ' has-error' : '' }}>
                                <label for="newpassword" class="col-md-6 control-label">New Password</label>
                                <input id="newpassword" type="password" class="form-control" name="newpassword" required autofocus>
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('confirmpassword') ? ' has-error' : '' }}">
                                <label for="confirmpassword" class="col-md-7 control-label">Confirm Password</label>
                                <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required autofocus>
                            </div>

                            <div class="col-md-6 form-group">
                                {{Form::hidden('_method', 'PUT')}}
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
        