<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function create()
    {
        return view ('image-upload');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Lưu ảnh
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Lưu thông tin vào database
        Image::create([
            'name' => $request->name,
            'email' => $request->email,
            'image_path' => 'images/'.$imageName,
        ]);

        return back()->with('success', 'Image uploaded successfully.');
    }
}

