@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="btn btn-primary" href="{{route('admin.technologies.index')}}" role="button">Back</a>
            </div>
            <div class="col">
                <form action="{{route('admin.technologies.update',$technology)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text"
                        class="form-control" name="name" id="name" aria-describedby="helpId" value="{{old('name', $technology->name)}}">
                    </div>

                    <div class="mb-3">
                    <img src="{{asset('storage/' . $technology->cover)}}" width="200" alt="{{$technology->name}}">

                      <label for="cover" class="form-label">Cover</label>
                      <input type="file"
                        class="form-control" name="cover" id="cover" aria-describedby="helpId" value="{{old('cover',$technology->cover)}}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection