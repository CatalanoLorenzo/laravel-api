@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success" role="alert">
    <strong>{{session('message')}}</strong>
</div>
@endif
<a name="" id="" class="btn btn-primary" href="{{route('admin.projects.create')}}" role="button">Add new Project</a>
<div class="table-responsive">
    <table class="table table-striped
        table-hover	
        table-borderless
        table-primary
        align-middle">
        <thead class="table-light">
            <caption>projects</caption>
            <tr>
                <th>ID</th>
                <th>Cover Image</th>
                <th>Title</th>
                <th>slug</th>
                <th>content</th>
                <th>Link Project</th>
                <th>Link Source</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($projects as $project)
            <tr class="table-primary">
                <td scope="row">{{$project->id}}</td>
                <td><img src="{{$project->cover}}" width="200" alt="{{$project->title}}"></td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->content}}</td>
                <td>{{$project->link}}</td>
                <td>{{$project->source}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('admin.projects.show',$project)}}" role="button">View</a>
                    <a class="btn btn-primary" href="{{route('admin.projects.edit',$project)}}" role="button">Edit</a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$project->id}}">
                        Delete
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modal-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modal-{{$project->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-{{$project->id}}">Delete {{$project->title}} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    are you very sure?
                                </div>
                                <div class="modal-footer">
                                <form action="{{route('admin.projects.destroy',$project)}}" method="post">
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