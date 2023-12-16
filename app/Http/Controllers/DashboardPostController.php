<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Catagory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.post.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.post.create', [
            'title' => 'Create Post',
            'catagories' => Catagory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'unique:posts|required',
            'image' => 'image|file|max:2048',
            'catagory_id' => 'required',
            'body' => 'required'
        ]);

        if($request->file('image')){
            $validatedata['image'] = $request->file('image')->store('post-image');
        }

        $validatedata['user_id'] = auth()->user()->id;
        $validatedata['excerpt'] = Str::limit(strip_tags($request->body), 75, '...');

        Post::create($validatedata);

        return redirect('/dashboard/post')->with('success', 'New Post Has Been Create!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show',[
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.post.edit', [
            'post' => $post,
            'catagories' => Catagory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'catagory_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];
        
        if($request->slug != $post->slug){
            $rules['slug'] = 'unique:posts|required';
        }
        
        $validatedata = $request->validate($rules);
        
        if($request->file('image')){
            if($request->old_image){
                Storage::delete($request->old_image);
            }
            $validatedata['image'] = $request->file('image')->store('post-image');
        }

        $validatedata['user_id'] = auth()->user()->id;
        $validatedata['excerpt'] = Str::limit(strip_tags($request->body), 75, '...');

        Post::where('id', $post->id)
                ->update($validatedata);

        return redirect('/dashboard/post')->with('success', 'Post Has Been Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        if($post->old_image){
            Storage::delete($post->old_image);
        }
        return redirect('/dashboard/post')->with('success', 'Post Has Been Delete!');
    }

    public function Cslug(Request $request)
    {     
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
