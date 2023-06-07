@extends('layouts.admin')
@section('content')
@if (session('message'))
    <div class="alert alert-success" role="alert">
        <strong>{{session('message')}}</strong>
    </div>
    @endif
<a class="btn btn-primary" href="{{Route('admin.posts.create')}}" role="button">Add Post</a>
<div class="table-responsive">
    <table class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
        <thead class="table-light">
            <caption>Posts</caption>
            <tr>
                <th>ID</th>
                <th>Cover Image</th>
                <th>Title</th>
                <th>slug</th>
                <th>content</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($posts as $post)
            <tr class="table-primary">
                <td scope="row">{{$post->id}}</td>
                <td><img src="{{$post->cover}}" width="200" alt="{{$post->title}}"></td>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>{{$post->content}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('admin.posts.show',$post)}}" role="button">View</a>
                    <a class="btn btn-primary" href="{{route('admin.posts.edit',$post)}}" role="button">Edit</a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$post->id}}">
                        Delete
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modal-{{$post->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modal-{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-{{$post->id}}">Delete {{$post->title}} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    are you very sure?
                                </div>
                                <div class="modal-footer">

                                    <form action="{{route('admin.posts.destroy',$post)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">yes!</button>
                                    </form>

                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Nop!</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Optional: Place to the bottom of scripts -->
                    <script>
                        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                    </script>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection