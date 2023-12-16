
@extends('layouts.main')
@section('container')
    <h1 class="mb-5 text-center">{{ $title }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/post" method="get">
                @if (request('catagory'))
                    <input type="hidden" name="catagory" value="{{ request('catagory') }}">
                @elseif (request('user'))
                    <input type="hidden" name="user" value="{{ request('user') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" name="search">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3">
            @if ($posts[0]->image)
                <img src="{{ $posts[0]->image }}" class="card-img-top" alt="{{ $posts[0]->catagory->title }}">
            @else
                <img src="" class="card-img-top" alt="">
            @endif
            <div class="card-body text-center">
            <h5 class="card-title fs-4"><a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>
            <p class="card-text">
                <small>
                    By <a href="/post/?user={{ $posts[0]->user->username }}" class="text-decoration-none">{{ $posts[0]->title }}</a>
                    in <a href="/post/?catagory={{ $posts[0]->catagory->slug }}" class="text-decoration-none">{{ $posts[0]->catagory->title }}</a>
                    {{ $posts[0]->created_at->diffForhumans() }}
                </small>
            </p>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>
            <a href="/post/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-dark">Read More..</a>
            </div>
        </div>        
    

    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)   
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if ($post->image)
                    <img src="{{ $post->image }}" class="card-img-top" alt="{{ $post->catagory->slug }}">
                    @else
                    <img src="" class="card-img-top" alt="">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            <small>
                                By <a href="/post/?user={{ $post->user->username }}" class="text-decoration-none">{{ $post->title }}</a>
                                {{ $post->created_at->diffForhumans() }}
                            </small>
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="/post/{{ $post->slug }}" class="btn btn-dark">Read More..</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <h1 class="fs-5">No Post</h1>
    @endif  

    <div class="d-flex justify-content-center"></div>
    {{ $posts->links() }}

@endsection