<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $request->user()->blogs()->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
    }


}
