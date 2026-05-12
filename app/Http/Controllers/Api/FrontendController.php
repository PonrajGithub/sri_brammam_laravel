<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Creator;
use App\Models\Post;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CreatorResource;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Reporter;
use App\Models\ReporterPerson;
use App\Models\GlobalConfig;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ReporterResource;
use App\Http\Resources\ReporterPersonResource;

class FrontendController extends Controller
{
    public function featuredCategories()
    {
        $categories = Category::where('status', true)->where('is_featured', true)->get();
        return CategoryResource::collection($categories);
    }

    public function topWriters()
    {
        $creators = Creator::where('status', true)->where('is_top_writer', true)->get();
        return CreatorResource::collection($creators);
    }

    public function editorsPicks()
    {
        $posts = Post::with(['category', 'creator'])
            ->where('status', true)
            ->where('is_editors_pick', true)
            ->latest()
            ->limit(6)
            ->get();
            
        return PostResource::collection($posts);
    }

    public function categories()
    {
        return CategoryResource::collection(Category::where('status', true)->get());
    }

    public function creators()
    {
        return CreatorResource::collection(Creator::where('status', true)->get());
    }

    public function posts(Request $request)
    {
        $posts = Post::with(['category', 'creator'])->where('status', true);
        
        if ($request->has('category_id')) {
            $categoryIds = is_array($request->category_id) ? $request->category_id : explode(',', $request->category_id);
            $posts->whereIn('category_id', $categoryIds);
        }
        
        if ($request->has('creator_id')) {
            $creatorIds = is_array($request->creator_id) ? $request->creator_id : explode(',', $request->creator_id);
            $posts->whereIn('creator_id', $creatorIds);
        }
        
        if ($request->has('search')) {
            $posts->where('title', 'like', '%' . $request->search . '%');
        }

        return PostResource::collection($posts->latest()->paginate(12));
    }

    public function clients()
    {
        return ClientResource::collection(Client::where('status', true)->latest()->get());
    }

    public function reporters()
    {
        return ReporterResource::collection(Reporter::where('status', true)->orderBy('list_order', 'asc')->latest()->get());
    }

    public function reporterPersons(Request $request)
    {
        $query = ReporterPerson::with('reporter')->where('status', true);

        if ($request->has('reporter_id')) {
            $query->where('reporter_id', $request->reporter_id);
        }

        return ReporterPersonResource::collection($query->latest()->get());
    }

    public function globalConfig()
    {
        $config = GlobalConfig::first();
        return response()->json([
            'success' => true,
            'data' => $config
        ]);
    }
}
