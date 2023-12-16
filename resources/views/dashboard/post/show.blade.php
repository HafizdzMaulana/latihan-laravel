@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 my-3">
                <a href="/dashboard/post" class="btn btn-primary">Back To All Post <i class="fa-solid fa-sheet-plastic"></i></a>
                <a href="/dashboard/post/{{ $post->slug }}/edit" class="btn btn-secondary">Edit Post <i class="fa-solid fa-pen-to-square"></i></a>
                <form action="/dashboard/post/{{ $post->slug }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure Want To Delete Selected Post?')">Delete <i class="fa-regular fa-trash-can"></i></button>
                </form>
                <div class="mb-3 mt-3">
                    @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid img-preview mb-3 col-sm-5" alt="{{ $post->catagory->slug }}">
                    @else
                    <img src="" class="img-fluid" alt="">
                    @endif
                    <h1 class="h2 text-center mt-2">{{ $post->title }}</h1>
                    <article class="fs-4 text-center">
                        {!! $post->body !!}<br>
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection