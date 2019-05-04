@extends('dashboard')

@section('subcontent')
    <div class="myprofile container">
        <h4>Update Profile</h4><hr>
        {!! Form::open(['action' => ['DashboardController@update', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
            <label for="name" class="col-sm-4 control-label">First Name</label>
            <div class="input-group input-group-md{{ $errors->has('name') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}" required autofocus>
            </div>
            <label for="last_name" class="col-sm-4 control-label">Last Name</label>
            <div class="input-group input-group-md{{ $errors->has('last_name') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{Auth::user()->last_name}}" required autofocus>
            </div>
            <label for="email" class="col-sm-4 control-label">E-Mail Address</label>
            <div class="input-group input-group-md{{ $errors->has('email') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i style="font-size:11px" class="fa fa-at"></i>
                </span>
                <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" required autofocus>
            </div>
            <label for="dob" class="col-sm-4 control-label">Birth Date</label>
            <div class="input-group input-group-md{{ $errors->has('dob') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i style="font-size:10px" class="fa fa-calendar"></i>
                </span>
                <input type="date" class="form-control" id="dob" name="dob" value="{{Auth::user()->dob}}" required autofocus>
            </div>
            <label for="gender" class="col-sm-4 control-label">Gender</label>
            <div class="input-group input-group-md{{ $errors->has('gender') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    @if (Auth::user()->gender == 'Female')
                        <i style="font-size:15px" class="fa fa-female"></i>
                    @else
                        <i style="font-size:15px" class="fa fa-male"></i>
                    @endif
                </span>
                <input type="text" class="form-control" id="gender" name="gender" value="{{Auth::user()->gender}}" required autofocus>
            </div>
            <label for="residence" class="col-sm-4 control-label">Residence</label>
            <div class="input-group input-group-md{{ $errors->has('residence') ? ' has-error' : '' }} col-md-6">
                <span class="input-group-addon">
                    <i style="font-size:10px" class="fa fa-building"></i>
                </span>
                <input type="text" class="form-control" id="residence" name="residence" value="{{Auth::user()->residence}}" required autofocus>
            </div>
            <label for="contacts" class="col-sm-4 control-label">Contacts</label>
            <div class="input-group input-group-md{{ $errors->has('contacts') ? ' has-error' : '' }} col-md-6">
                <span class="input-group-addon">
                    <i style="font-size:11px" class="fa fa-phone"></i>
                </span>
                <input type="text" class="form-control" id="contacts" name="contacts" value="{{Auth::user()->contacts}}" required autofocus>
            </div>
            <label for="qualification" class="col-sm-4 control-label">Qualification</label>
            <div class="input-group input-group-md{{ $errors->has('qualification') ? ' has-error' : '' }} col-md-6">
                <span class="input-group-addon">
                    <i style="font-size:10px" class="fa fa-graduation-cap"></i>
                </span>
                <input type="text" class="form-control" id="qualification" name="qualification" value="{{Auth::user()->qualification}}" required autofocus>
            </div>
            {{Form::hidden('_method', 'PUT')}}
            <button style="margin-top:20px" type="submit" class="btn btn-success col-md-offset-4">
                Save Changes
            </button>
        {!!Form::close()!!}
    </div>
@endsection