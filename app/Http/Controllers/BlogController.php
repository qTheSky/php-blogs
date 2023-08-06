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

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $sortBy = $request->input('sortBy', 'created_at');
        $sortDirection = $request->input('sortDirection', 'desc');

        // Ограничим возможные поля для сортировки
        if (!in_array($sortBy, ['created_at', 'name'])) {
            $sortBy = 'created_at';
        }

        // Ограничим возможные направления сортировки
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $blogs = Blog::orderBy($sortBy, $sortDirection)->paginate($perPage);
        return response()->json($blogs);
    }



}
