<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Gallery $gallery)
    {
        // Retrieve a list of galleries
        $images = $gallery->images;

        return response()->json($images);
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
        $maxPhotosPerCollection = config('gallery.max_photos_per_collection');
        $maxFileSize = config('gallery.max_file_size');


        $validator = Validator::make(request()->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:' . $maxFileSize,
        ]);

        $photoCount = Image::where('gallery_id', $request->gallery_id)->count();

        $validator->after(function ($validator) use ($photoCount, $maxPhotosPerCollection) {
            if ($photoCount >= $maxPhotosPerCollection) {
                $validator->errors()->add('photo', 'The number of photos exceeds the maximum allowed ' . $maxPhotosPerCollection);
            }
        });

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }
    
        if ($request->file('photo')) {

            $fileName = time() . '_' . Str::random(10) . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/photos', $fileName);

            $type = $request->file('photo')->getClientOriginalExtension();
            $size = $request->file('photo')->getSize();

            $image = new Image();
            $image->path = 'photos/' . $fileName;
            $image->type = $type;
            $image->size = $size;
            $image->gallery_id = $request->gallery_id;
            $image->save();
    
            return response()->json(['message' => 'Photo uploaded successfully']);
        }
    
        return response()->json(['message' => 'Photo upload failed'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
