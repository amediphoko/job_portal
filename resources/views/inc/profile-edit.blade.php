<a style="float:right; padding:10px" data-toggle="modal" href="#editModal">
    <i class="fa fa-pencil"></i> Edit
</a>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if (Auth::guard('employer')->check())
                {!! Form::open(['action' => ['EmployerController@update', Auth::user()->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            @elseif (Auth::guard('web')->check())
                {!! Form::open(['action' => ['DashboardController@update', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
            @endif
                {{ csrf_field() }}
                <!-- Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel" style="text-align:center">Update Profile</h4>
                </div>
                <!-- Body -->
                <div class="modal-body">
                    @if (Auth::guard('employer')->check())
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
                    @else
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
                                <i style="font-size:10px" class="fa fa-gender"></i>
                            </span>
                            <input type="text" class="form-control" id="gender" name="gender" value="{{Auth::user()->gender}}" required autofocus>
                        </div>
                        <label for="residence" class="col-sm-4 control-label">Residence</label>
                        <div class="input-group input-group-md{{ $errors->has('residence') ? ' has-error' : '' }} col-md-6">
                            <span class="input-group-addon">
                                <i style="font-size:16px" class="fa fa-building"></i>
                            </span>
                            <input type="text" class="form-control" id="residence" name="residence" value="{{Auth::user()->residence}}" required autofocus>
                        </div>
                        <label for="contacts" class="col-sm-4 control-label">Contacts</label>
                        <div class="input-group input-group-md{{ $errors->has('contacts') ? ' has-error' : '' }} col-md-6">
                            <span class="input-group-addon">
                                <i style="font-size:12px" class="fa fa-phone"></i>
                            </span>
                            <input type="text" class="form-control" id="contacts" name="contacts" value="{{Auth::user()->contacts}}" required autofocus>
                        </div>
                        <label for="qualification" class="col-sm-4 control-label">Qualification</label>
                        <div class="input-group input-group-md{{ $errors->has('qualification') ? ' has-error' : '' }} col-md-6">
                            <span class="input-group-addon">
                                <i style="font-size:12px" class="fa fa-graduation-cap"></i>
                            </span>
                            <input type="text" class="form-control" id="qualification" name="qualification" value="{{Auth::user()->qualification}}" required autofocus>
                        </div>
                    @endif
                </div>
                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close </button>
                    {{Form::hidden('_method', 'PUT')}}
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>