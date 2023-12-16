@extends('layouts.main')
{{-- @dd($post->body) --}}
@section('container')   
    <div class="container text-center">
        <div class="row  justify-content-center">
            <div class="col-md-8">
                <h1>{{ $post->title }}</h1>
                <p class="">By {{ $post->user->name }} in <a href="/post/?catagory={{ $post->catagory->slug }}" class="text-decoration-none">{{ $post->catagory->title }}</a></p>
                <article class="fs-4">
                    {!! $post->body !!}<br>
                </article>
                <a href="/post" class="text-decoration-none btn btn-dark mb-2">Kembali</a>
            </div>
        </div>
    </div>
@endsection
