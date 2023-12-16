<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Catagory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $title = '';
        if(request('user')){
            $user = User::firstWhere('username', request('user'));
            $title = 'From By' . $user->name;
        }
        if(request('catagory')){
            $cata = Catagory::firstWhere('slug', request('catagory'));
            $title = 'From Catagory' . $cata->nama;
        }

        return view('post', [
            "title" => "All Post",
            // "posts" => collect(Post::all())
            "posts" => Post::latest()->search(request(['search', 'catagory', 'user']))
                        ->with(['catagory', 'user'])->paginate(7)->withQueryString()
        ]);
    }

    public function detail(Post $post)
    {
        return view('detail', [
            "title" => "detail",
            "post" => $post
        ]);
    }
}
