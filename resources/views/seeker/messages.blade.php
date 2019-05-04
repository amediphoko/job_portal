@extends('dashboard')

@section('subcontent')
    <div class="messages container">
        <h4>Messages ({{count($inboxes)}})</h4>
        <hr>
        <div class="row clearfix">
            <div class="col-lg-12 hd">
                <div class="card action_bar">
                    <div class="body">
                        <div class="row clearfix">                    
                                                                                
                        </div>
                    </div>
                </div>
            </div>         
        </div>
        <div class="table-responsive">
            <div style="color:black;font-weight:600;padding:8px;" class="col-lg-1 col-md-2 col-3">
                <input class="col-md-6" type="checkbox" name="all[]" id="all">
                All
            </div>
            <div class="col-lg-1 col-md-2 col-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-filter"></i> Filter <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/dashboard/messages/{{Auth::user()->id}}">All</a></li>
                        <li><a href="/dashboard/messages/{{Auth::user()->id}}?status=read">Read</a></li>
                        <li><a href="/dashboard/messages/{{Auth::user()->id}}?status=unread">Unread</a></li>
                    </ul>
                </div>                               
            </div>
            <div class="col-lg-6 col-md-4 col-6 pull-right">   
                <form action="{{url('inbox_search')}}" method="GET" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="searchterm" class="form-control" placeholder="Search...">
                    </div>
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </form> 
            </div>  
            <form action="{{ url('delete_msg') }}" method="POST">
                {{ csrf_field() }}
                <div style="margin-left:20px" class="col-lg-1 col-md-2 col-3">
                    <button class="btn btn-default btn-sm tooltips" type="submit" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete" onclick ="return confirm('Are you sure you want to delete?')">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
                <table class="table table-hover table-email">
                    @if (count($inboxes) > 0)
                    <tbody>       
                        @foreach ($inboxes as $inbox)
                        <tr class="{{$inbox->status}} clickable-row" data-href="/dashboard/{{$inbox->id}}" >
                                <td> 
                                    <div class="ckbox ckbox-theme">
                                        <input id="{{$inbox->id}}" type="checkbox" name="inbox[]" value="{{$inbox->id}}" class="mail-checkbox">
                                        <label for="{{$inbox->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="media">
                                        <div class="pull-left">
                                            <img alt="..." src="/storage/company_logos/{{$inbox->employer->logo}}" class="media-object">
                                        </div>
                                        <div class="media-body">
                                            <p class="text-primary">{{$inbox->employer->name}}</p>
                                            <small class="pull-right text-muted"><time class="hidden-sm-down" datetime="2017">12:35 AM</time></small>
                                            <p class="subject">{{$inbox->subject}}</p>
                                            <p class="email-summary">
                                                {{strip_tags($inbox->message)}}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @else
                        <div class="col-md-12">
                            <p style="text-align:center;padding:30px"><b>No Messages.</b></p>
                        </div>
                    @endif
                </table>
            </form>
            @if (count($inboxes) > 0)
                <div class="card m-t-5">
                    <div class="body" style="text-align:center">
                        {{$inboxes->links()}}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection