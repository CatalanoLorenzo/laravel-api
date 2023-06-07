@extends('layouts.admin')
@section('content')
<form action="{{route('admin.projects.store')}}" method="post">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text"  @error ('title') is-invalid @enderror  class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="" value="{{old('title')}}">
        <small id="helpId" class="form-text text-muted">Help text</small>
        @error('title')
      <div class="alert alert-danger" role="alert">
        <strong>Title,Error: </strong>{{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="cover" class="form-label">Cover</label>
        <input type="text" @error ('cover') is-invalid @enderror class="form-control" name="cover" id="cover" aria-describedby="helpId" placeholder="" value="{{old('cover')}}">
        <small id="helpId" class="form-text text-muted">Help text</small>
        @error('cover')
      <div class="alert alert-danger" role="alert">
        <strong>Cover,Error: </strong>{{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="link" class="form-label">Link Project</label>
        <input type="text" @error ('link') is-invalid @enderror class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="" value="{{old('link')}}">
        <small id="helpId" class="form-text text-muted">Help text</small>
        @error('link')
      <div class="alert alert-danger" role="alert">
        <strong>Link,Error: </strong>{{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="source" class="form-label">Source link</label>
        <input type="text" @error ('source') is-invalid @enderror class="form-control" name="source" id="source" aria-describedby="helpId" placeholder="" value="{{old('source')}}">
        <small id="helpId" class="form-text text-muted">Help text</small>
        @error('source')
      <div class="alert alert-danger" role="alert">
        <strong>Source,Error: </strong>{{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" @error ('content') is-invalid @enderror name="content" id="content" rows="3">{{old('content')}}</textarea>
        @error('content')
      <div class="alert alert-danger" role="alert">
        <strong>Content,Error: </strong>{{$message}}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">ADD</button>
</form>
@endsection