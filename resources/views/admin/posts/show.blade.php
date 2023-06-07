@extends('layouts.admin')
@section('content')
<a  class="btn btn-primary" href="{{route('admin.posts.index')}}" role="button">BACK</a>
    <div class="container">
        <div class="row">
            <div class="card ">
                <img class="m-auto" width="500" src="{{$post->cover}}" alt="{{$post->title}}">
                <div class="card-body">
                    <h4 class="card-title">{{$post->title}}</h4>
                    <p class="card-text">{{$post->content}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection