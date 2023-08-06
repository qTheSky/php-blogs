<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->authorize('create', $blog);

        $post = new Post($request->all());
        $blog->posts()->save($post);

    }


    public function destroy(Blog $blog, Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
    }
}
