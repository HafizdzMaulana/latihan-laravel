@extends('layouts.main')

@section('container')
    @foreach ($catagorys as $catagory)        
    <ul>
        <li><a href="/post/?catagory={{ $catagory->slug }}" class="text-decoration-none">{{ $catagory->title }}</a></li>
    </ul>
    @endforeach
@endsection