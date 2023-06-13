@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>ADD new Type</h2>
            <div class="input-group mb-3">
                <form action="{{route('admin.types.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button class="btn btn-outline-primary p-2 m-3" type="submit" id="">ADD TYPE</button>
                    <input type="text" class="form-control p-2 m-3" placeholder="write here new type" aria-label="Button" name="name" id="name">
                    <input type="file" class="form-control p-2 m-3" placeholder="write here new link for cover" aria-label="Button" name="cover" id="cover">
                </form>
            </div>
        </div>
        <div class="col">
            <h1>Types</h1>
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
                        @foreach ($types as $type)
                        <tr class="table-primary">
                            <td scope="row">{{$type->id}}</td>
                            <td><img src="{{asset('storage/' . $type->cover)}}" width="200" alt="{{$type->name}}"></td>
                            <td>{{$type->name}}</td>
                            <td>{{$type->count()}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.types.show' , $type )}}" role="button">VIEW</a>
                                <a class="btn btn-primary" href="{{route('admin.types.edit' , $type )}}" role="button">Edit</a>




                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#{{$type->id}}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="{{$type->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="{{$type->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{$type->id}}">{{$type->name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Body
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                <form action="{{route('admin.types.destroy',$type)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Optional: Place to the bottom of scripts -->
                                <script>
                                    const myModal = new bootstrap.Modal(document.getElementById('{{$type->id}}'), options)
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
            <h2>Type Select</h2>
            @if ($singletype)
            <div class="card">
                <img class="card-img-top" src="{{asset('storage/' . $singletype->cover)}}" alt="{{$singletype->name}}">
                <div class="card-body">
                    <h4 class="card-title text-center">{{$singletype->name}}</h4>
                    <p class="card-text text-center">{{$singletype->slug}}</p>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert">
                <strong>Select Type</strong>
            </div>

            @endif





        </div>
    </div>
</div>
@endsection