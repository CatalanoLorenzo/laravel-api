@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>ADD new Type</h2>
                <div class="input-group mb-3">
                    <form action="{{route('admin.types.store')}}" method="post">
                        @csrf
                        <button class="btn btn-outline-primary p-2 m-3" type="submit" id="">ADD TYPE</button>
                        <input type="text" class="form-control p-2 m-3" placeholder="write here new type" aria-label="Button" name="name" id="name">
                        <input type="text" class="form-control p-2 m-3" placeholder="write here new link for cover" aria-label="Button" name="cover" id="cover">
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
                            <caption>Types</caption>
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
                                <tr class="table-primary" >
                                    <td scope="row">{{$type->id}}</td>
                                    <td><img src="{{$type->cover}}" width="200" alt="{{$type->name}}"></td>
                                    <td>{{$type->name}}</td>
                                    <td>{{$type->count()}}</td>
                                    <td>
                                        <a  class="btn btn-primary" href="{{route('admin.types.edit' , $type )}}" role="button">Edit</a>
                                        <form action="{{route('admin.types.destroy',$type)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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
@endsection