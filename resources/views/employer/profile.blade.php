@extends('employer')

@section('subcontent')
    <div class="myprofile container">
        <h4>Update Profile</h4><hr>
        {!! Form::open(['action' => ['EmployerController@update', Auth::user()->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <label for="name" class="col-sm-4 control-label">Company Name</label>
            <div class="input-group input-group-md{{ $errors->has('name') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}" required autofocus>
            </div>
            <label for="email" class="col-sm-4 control-label">E-Mail Address</label>
            <div class="input-group input-group-md{{ $errors->has('email') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i style="font-size:11px" class="fa fa-at"></i>
                </span>
                <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" required autofocus>
            </div>
            <label for="industry" class="col-sm-4 control-label">Industry</label>
            <div class="input-group input-group-md{{ $errors->has('industry') ? ' has-error' : '' }} col-sm-6">
                <span class="input-group-addon">
                    <i style="font-size:10px" class="fa fa-industry"></i>
                </span>
                <input type="text" class="form-control" id="industry" name="industry" value="{{Auth::user()->industry}}" required autofocus>
            </div>
            <label for="location" class="col-sm-4 control-label">Location</label>
            <div class="input-group input-group-md{{ $errors->has('location') ? ' has-error' : '' }} col-md-6">
                <span class="input-group-addon">
                    <i style="font-size:16px" class="fa fa-map-marker"></i>
                </span>
                <input type="text" class="form-control" id="location" name="location" value="{{Auth::user()->location}}" required autofocus>
            </div>
            <label for="contacts" class="col-sm-4 control-label">Contacts</label>
            <div class="input-group input-group-md{{ $errors->has('contacts') ? ' has-error' : '' }} col-md-6">
                <span class="input-group-addon">
                    <i style="font-size:12px" class="fa fa-phone"></i>
                </span>
                <input type="text" class="form-control" id="contacts" name="contacts" value="{{Auth::user()->contacts}}" required autofocus>
            </div>
            {{Form::hidden('_method', 'PUT')}}
            <button style="margin-top:20px" type="submit" class="btn btn-success col-md-offset-4">
                <i class="fa fa-save"></i> Save Changes
            </button>
        {!!Form::close()!!}
    </div>
@endsection