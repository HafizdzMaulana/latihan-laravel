@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
        <h1 class="h2">Create New Catagory</h1>
        </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3">
    <a href="/dashboard/catagories" class="btn btn-primary">Back To Catagory Post</a>
  </div>
  <div class="col-lg-6 mb-5">
      <form method="POST" action="/dashboard/catagories">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Catagory Name</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
          @error('title')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" required>
            @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
        <button type="submit" class="btn btn-primary">Create Catagory</button>
      </form>
  </div>

  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/catagories/Cslug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });
  </script>
@endsection