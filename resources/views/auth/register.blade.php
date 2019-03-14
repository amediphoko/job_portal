@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-4 control-label">Date of Birth</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ old('dob') }}" required autofocus>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-sm-offset-4" style="padding-left:1em">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="female" value="Female" checked> Female
                                    </label>
                                </div>
                                <div class="radio">
                                    <label> <input type="radio" name="gender" id="male" value="Male"> Male
                                    </label>
                                </div>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contacts') ? ' has-error' : '' }}">
                            <label for="contacts" class="col-md-4 control-label">Contacts</label>

                            <div class="col-md-6">
                                <input id="contacts" type="tel" class="form-control" name="contacts" value="{{ old('contacts') }}" placeholder="(+267)" required>

                                @if ($errors->has('contacts'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contacts') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('residence') ? ' has-error' : '' }}">
                            <label for="residence" class="col-md-4 control-label">Residence</label>

                            <div class="col-md-6">
                                <input id="residence" type="text" class="form-control" name="residence" value="{{ old('residence') }}" required>

                                @if ($errors->has('residence'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('residence') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('qualification') ? ' has-error' : '' }}">
                            <label for="qualification" class="col-md-4 control-label">Qualification</label>

                            <div class="col-md-6">
                                <input id="qualification" type="text" class="form-control" name="qualification" value="{{ old('qualification') }}" required>

                                @if ($errors->has('qualification'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pro_pic') ? ' has-error' : '' }}">
                            <label for="pro_pic" class="col-md-4 control-label">Profile Picture</label>

                            <div class="col-md-6">
                                <input id="pro_pic" type="file" name="pro_pic" autofocus>

                                @if ($errors->has('pro_pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pro_pic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('documents') ? ' has-error' : '' }}">
                            <label for="documents" class="col-md-4 control-label">Documents</label>

                            <div class="col-md-6">
                                <input id="documents" type="file" name="documents" autofocus>

                                @if ($errors->has('documents'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('documents') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
