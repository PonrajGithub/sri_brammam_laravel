<?php

namespace App\Http\Controllers;

use App\Models\VideoUrl;
use Illuminate\Http\Request;

class VideoUrlController extends Controller
{
    public function index()
    {
        $videoUrls = VideoUrl::latest()->get();
        return view('admin.video_urls.index', compact('videoUrls'));
    }

    public function create()
    {
        return view('admin.video_urls.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        VideoUrl::create($validated);

        return redirect()->route('admin.video-urls.index')->with('success', 'Video URL created successfully.');
    }

    public function edit(VideoUrl $videoUrl)
    {
        return view('admin.video_urls.edit', compact('videoUrl'));
    }

    public function update(Request $request, VideoUrl $videoUrl)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $videoUrl->update($validated);

        return redirect()->route('admin.video-urls.index')->with('success', 'Video URL updated successfully.');
    }

    public function destroy(VideoUrl $videoUrl)
    {
        $videoUrl->update(['status' => !$videoUrl->status]);

        $status = $videoUrl->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.video-urls.index')->with('success', "Video URL {$status} successfully.");
    }
}
