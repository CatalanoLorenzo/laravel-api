@extends('layouts.admin')
@section('content')
<a  class="btn btn-primary" href="{{route('admin.projects.index')}}" role="button">BACK</a>
    <div class="container">
        <div class="row">
            <div class="card ">
                <img class="m-auto" width="500" src="{{$project->cover}}" alt="{{$project->title}}">
                <div class="card-body">
                    <h4 class="card-title">{{$project->title}}</h4>
                    <p class="card-text">{{$project->content}}</p>
                    <p class="card-text">{{$project->link}}</p>
                    <p class="card-text">{{$project->source}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection