<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Http\Requests\StoreCatagoryRequest;
use App\Http\Requests\UpdateCatagoryRequest;

class CatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
                            // membuat parameter yang dijadikan objek baru
    public function index(Catagory $catagory)
    {
        // return view('post', [
        //     'title' => $catagory->nama,
        //     'posts' => collect($catagory->post->with('user', 'catagory')),
        //     'catagory' => $catagory->nama
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatagoryRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatagoryRequest $request, Catagory $catagory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catagory $catagory)
    {
        //
    }
}
