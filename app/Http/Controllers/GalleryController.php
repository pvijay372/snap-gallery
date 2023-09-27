<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve a list of galleries
        $galleries = Gallery::with('firstImage')->get();

        return response()->json($galleries);
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
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'collectionName' => 'required|unique:galleries,name',
        ]);
    
        $gallery = new Gallery();
        $gallery->email = $request->email;
        $gallery->name = $request->collectionName;
        $gallery->save();
    
        return response()->json(['message' => 'Gallery created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return response()->json($gallery);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'email' => 'required|email',
            'collectionName' => 'required|unique:galleries,name',
        ]);
    
        $gallery->update([
            'email' => $request->email,
            'name' => $request->collectionName,
        ]);
    
        return response()->json(['message' => 'Gallery updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
