<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'creator']);
        
        if ($request->has('search')) {
            $posts->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('category_id')) {
            $posts->where('category_id', $request->category_id);
        }

        return PostResource::collection($posts->paginate(10));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('posts/pdfs', 'public');
        }

        $post = Post::create($data);

        return new PostResource($post->load(['category', 'creator']));
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['category', 'creator']));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

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

        return new PostResource($post->load(['category', 'creator']));
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        if ($post->pdf_path) {
            Storage::disk('public')->delete($post->pdf_path);
        }
        
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
