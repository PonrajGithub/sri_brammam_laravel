<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'creator'])->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $creators = Creator::all();
        return view('admin.posts.create', compact('categories', 'creators'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'category_id' => 'required|exists:categories,id',
            'creator_id' => 'required|exists:creators,id',
            'read_time' => 'required|integer|min:0',
            'is_editors_pick' => 'boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'creator_id' => $validated['creator_id'],
            'read_time' => $validated['read_time'],
            'is_editors_pick' => $request->has('is_editors_pick'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('posts/pdfs', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $creators = Creator::all();
        return view('admin.posts.edit', compact('post', 'categories', 'creators'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
            'category_id' => 'required|exists:categories,id',
            'creator_id' => 'required|exists:creators,id',
            'read_time' => 'required|integer|min:0',
            'is_editors_pick' => 'boolean',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'creator_id' => $validated['creator_id'],
            'read_time' => $validated['read_time'],
            'is_editors_pick' => $request->has('is_editors_pick'),
        ];

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($post->pdf_path) {
                Storage::disk('public')->delete($post->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf')->store('posts/pdfs', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->update(['status' => !$post->status]);

        $status = $post->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.posts.index')->with('success', "Post {$status} successfully.");
    }
}
