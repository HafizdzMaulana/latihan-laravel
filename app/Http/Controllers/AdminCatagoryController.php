<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard.catagories.index', [
            'catagory' => Catagory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.catagories.create', [
            'catagories' => Catagory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'title' => 'required|max:30',
            'slug' => 'required|unique:catagories'
        ]);

        Catagory::create($validatedata);

        return redirect('/dashboard/catagories')->with('success', 'New Catagory Has Been Create!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catagory $catagory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catagory $catagory)
    {
        return view('dashboard.catagories.edit', [
            'catagory' => $catagory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catagory $catagory)
    {
        $validatedata = $request->validate([
            'title' => 'required|max:30',
            'slug' => 'required|unique:catagories'
        ]);

        Catagory::where('id', $catagory->id)
                    ->update($validatedata);
        
        return redirect('/dashboard/catagories')->with('success', 'Catagory Has Been Update!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catagory $catagory)
    {
        Catagory::destroy($catagory->id);
        return redirect('/dashboard/catagories')->with('success', 'Catagory Has Been Delete!');
    }

    public function Cslug(Request $request)
    {     
        $slug = SlugService::createSlug(Catagory::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
