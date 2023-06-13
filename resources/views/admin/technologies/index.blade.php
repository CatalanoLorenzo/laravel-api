@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Add new Technology</h2>
            <div class="input-group mb-3">
                <form action="{{route('admin.technologies.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button class="btn btn-outline-primary p-2 m-3" type="submit" id="">ADD technology</button>
                    <input type="text" class="form-control p-2 m-3" placeholder="write here new technology" aria-label="Button" name="name" id="name">
                    <input type="file" class="form-control p-2 m-3" placeholder="write here new link for cover" aria-label="Button" name="cover" id="cover">
                </form>
            </div>
        </div>
        <div class="col">
            <h1>Technologies</h1>
            <div class="table-responsive">
                <table class="table table-striped
                    table-hover	
                    table-borderless
                    table-primary
                    align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Cover</th>
                            <th>Name</th>
                            <th>Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($technologies as $technology)
                        <tr class="table-primary">
                            <td scope="row">{{$technology->id}}</td>
                            <td>
                                <img src="{{asset('storage/' . $technology->cover)}}" width="200" alt="{{$technology->name}}">
                            </td>
                            <td>{{$technology->name}}</td>
                            <td>{{$technology->projects->count()}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.technologies.show' , $technology )}}" role="button">VIEW</a>
                                <a class="btn btn-primary" href="{{route('admin.technologies.edit' , $technology )}}" role="button">Edit</a>


                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#{{$technology->id}}">
                                    DELETE
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="{{$technology->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="{{$technology->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{$technology->id}}">{{$technology->name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                are you sure?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{route('admin.technologies.destroy',$technology)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary">delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Optional: Place to the bottom of scripts -->
                                <script>
                                    const myModal = new bootstrap.Modal(document.getElementById('{{$technology->id}}'), options)
                                </script>



                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Technology Select</h2>
            @if ($singletechnology)
            <div class="card">
                <img src="{{asset('storage/' . $singletechnology->cover)}}" alt="{{$technology->name}}">

                <div class="card-body">
                    <h4 class="card-title text-center">{{$singletechnology->name}}</h4>
                    <p class="card-text text-center">{{$singletechnology->slug}}</p>
                    <p class="card-text text-center">{{$singletechnology->projects->count()}}</p>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert">
                <strong>Select Technology !</strong>
            </div>

            @endif

        </div>
    </div>
</div>
@endsection