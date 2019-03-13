@extends('layouts.app')

@section('content')
    <h1>Search</h1>
    <form action="{{URL::to('/search')}}" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="title" placeholder="Job Title"><span class="input-group-btn"></span>
        </div>
        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
    </form>
@endsection