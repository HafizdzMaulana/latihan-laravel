@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
        <h1 class="h2">Edit Post</h1>
        </div>
  </div>
  <div class="col-lg-8 mb-5">
      <form method="POST" action="/dashboard/post/{{ $post->slug }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" required autofocus>
          @error('title')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" required>
          @error('slug')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label @error('image') is-invalid @enderror" for="image">Uploud Image</label>
          <input type="file" class="form-control" id="image" name="image" onchange="imagepreview()">
          <input type="hidden" name="old_image" value="{{ $post->image }}">
          @if ($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" class="image-preview img-fluid mt-3 d-block">
          @else
          <img class="image-preview img-fluid mt-3">
          @endif
          @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div> 
        <div class="mb-3">
          <label for="catagory" class="form-label">Catagory</label>
          <select class="form-select" name="catagory_id">
            <option selected disabled>Open this select Catagory</option>
            @foreach ($catagories as $cata)
              @if (old('catagory_id', $post->catagory_id) == $cata->id)
              <option value="{{ $cata->id }}" selected>{{ $cata->title }}</option>
              @else
              <option value="{{ $cata->id }}">{{ $cata->title }}</option>
              @endif
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="body" class="form-label">Body</label>
          @error('body')
              <p class="text-danger">{{ $message }}</p>
          @enderror
          <input id="x" type="hidden" id="body" name="body" value="{{ old('body', $post->body) }}">
          <trix-editor input="x"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
      </form>
  </div>

  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/post/Cslug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });

    document.addEventListener('trix-file-accept', function(e){

    });

    function imagepreview(){
      const img = document.querySelector('#image');
      const imgpreview = document.querySelector('.image-preview');

      imgpreview.style.display = 'block';
      
      const ofreader = new FileReader();
      ofreader.readAsDataURL(img.files[0]);

      ofreader.onload = function(oFREvent){
        imgpreview.src = oFREvent.target.result;
      }
    }
  </script>
@endsection