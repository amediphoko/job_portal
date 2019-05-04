<a style="float:right;" data-toggle="modal" href="#emailModal" class="btn btn-primary">
    <i class="fa fa-inbox"></i> Email
</a>
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['action' => 'EmployerController@sendmail', 'method' => 'POST']) !!}
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="text-align:center">Email Response to Shortlisted Candidates</h4>
            </div>
            <!-- Body -->
            <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{Form::label('emails', 'Emails')}}
                        {{Form::text('emails', json_encode($receipients), ['class' => 'form-control', 'data-role' => 'tagsinput'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('subject', 'Subject')}}
                        {{Form::text('subject', '', ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('message', 'Message')}}
                        {{Form::textarea('message', '', ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
                    </div>
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                       <i class="fa fa-close"></i> Close
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-send"></i> Send
                    </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>