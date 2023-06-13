@extends('layouts.admin')
@section('content')
<form action="{{route('admin.projects.update',$project)}}" method="post"  enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" @error ('title') is-invalid @enderror class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="" value="{{old('title',$project->title)}}">
    <small id="helpId" class="form-text text-muted">Help text</small>
    @error('title')
    <div class="alert alert-danger" role="alert">
      <strong>Title,Error: </strong>{{$message}}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="cover" class="form-label">Cover</label>
    <img src="{{asset('storage/' . $project->cover)}}" alt="">
    <input type="file" @error ('cover') is-invalid @enderror class="form-control" name="cover" id="cover" aria-describedby="helpId" placeholder="" value="{{old('cover',$project->cover)}}">
    <small id="helpId" class="form-text text-muted">Help text</small>
    @error('cover')
    <div class="alert alert-danger" role="alert">
      <strong>Cover,Error: </strong>{{$message}}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="type_id" class="form-label">Type</label>
    <select class="form-select form-select-lg" name="type_id" id="type_id" @error ('type_id') is-invalid @enderror >
      @foreach ($types as $type)
      <option value="{{$type->id}}" {{ $type->id  == old('type_id', '') ? 'selected' : '' }}>{{$type->name}}</option>
      @endforeach
    </select>
    @error('type_id')
    <div class="alert alert-danger" role="alert">
      <strong>type_id,Error: </strong>{{$message}}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="link" class="form-label">Link Project</label>
    <input type="text" @error ('link') is-invalid @enderror class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="" value="{{old('link',$project->link)}}">
    <small id="helpId" class="form-text text-muted">Help text</small>
    @error('link')
    <div class="alert alert-danger" role="alert">
      <strong>Link,Error: </strong>{{$message}}
    </div>
    @enderror
  </div>

  <div class="form-group">
        <p>Seleziona i tag:</p>
        @foreach ($technologies as $technology)
        <div class="form-check @error('technologies') is-invalid @enderror">
            <label class="form-check-label">
                @if($errors->any())
                {{-- se ci sono degli errori di validazione
                signifca che bisogna recuperare i tag selezionati
                tramite la funzione old(),
                la quale restituisce un array plain contenente solo gli id --}}

                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>

                @else
                {{-- se non sono presenti errori di validazione
				significa che la pagina è appena stata aperta per la prima volta,
				perciò bisogna recuperare i tag dalla relazione con il post,
				che è una collection di oggetti di tipo Tag	--}}

                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                @endif


                {{ $technology->name }}
            </label>

        </div>
        @endforeach
        @error('technologies')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

  <div class="mb-3">
    <label for="source" class="form-label">Link Ssource</label>
    <input type="text" @error ('source') is-invalid @enderror class="form-control" name="source" id="source" aria-describedby="helpId" placeholder="" value="{{old('source',$project->source)}}">
    <small id="helpId" class="form-text text-muted">Help text</small>
    @error('source')
    <div class="alert alert-danger" role="alert">
      <strong>Source,Error: </strong>{{$message}}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="content" class="form-label">Content</label>
    <textarea class="form-control" @error ('content') is-invalid @enderror name="content" id="content" rows="3">{{old('content',$project->content)}}</textarea>
    @error('content')
    <div class="alert alert-danger" role="alert">
      <strong>Content,Error: </strong>{{$message}}
    </div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">ADD</button>
</form>
@endsection