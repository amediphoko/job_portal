@extends('dashboard')

@section('subcontent')
    <div class="cv-cover container">
        <h4>Documents</h4><hr>
        {!! Form::open(['action' => ['DashboardController@update_documents', Auth::user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="cv col-md-12" style="padding-bottom:20px">
                <div class="col-md-2 col-md-offset-2">
                    <input type="file" name="documents[]" id="documents" multiple />
                    <label for="documents">
                        <img width="50px" style="margin-left:18px" src="{{asset('img/upload.png')}}" alt=""><br>Upload Docs
                    </label>
                </div>
                <div class="docs col-md-8">
                    <h5><strong>CV and Certified Documents</strong></h5>
                    <ol>
                        @foreach (json_decode(Auth::user()->documents) as $document)
                            <li><a href="/download/{{$document}}"><i style="color:red" class="fa fa-file-pdf-o"></i> {{ $document }}</a></li><br/>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="cover col-md-offset-1">
                <h5><strong>Cover Letter</strong></h5> 
                    <div class="col-md-10 form-group">
                        {{Form::label('description', 'Brief Description')}}
                        {{Form::textarea('description', Auth::user()->cover_letter, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Job Description'])}}
                    </div>
            </div>
            {{Form::hidden('_method', 'PUT')}}
                <button style="margin-top:20px" type="submit" class="btn btn-success col-md-offset-4">
                    <i class="fa fa-save"></i> Update Changes
                </button>
        {!! Form::close() !!}
        <hr>
    </div>
@endsection