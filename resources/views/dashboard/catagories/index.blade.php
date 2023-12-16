@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <div class="btn-toolbar mb-2 mb-md-0">
    <h1 class="h2">Post Catagory</h1>
  </div>
</div>

<h2>Section title</h2>
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show col-lg-6" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="table-responsive small">
      <a href="/dashboard/catagories/create" class="btn btn-primary my-2">Create New Catagory</a>
      <div class="table-responsive col-lg-6">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Catagory Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($catagory as $cata)    
                  <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $cata->title }}</td>
                  <td>
                    <a href="/dashboard/catagories/{{ $cata->slug }}/edit" class="badge bg-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="/dashboard/catagories/{{ $cata->slug }}" method="POST" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="badge bg-danger border-0" onclick="return confirm('Are You Sure Want To Delete Selected Post?')"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                  </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>



@endsection