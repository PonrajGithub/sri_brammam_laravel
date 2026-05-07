<?php

namespace App\Http\Controllers;

use App\Models\LatestRelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LatestReleaseController extends Controller
{
    public function index()
    {
        $releases = LatestRelease::latest()->get();
        return view('admin.latest_releases.index', compact('releases'));
    }

    public function create()
    {
        return view('admin.latest_releases.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'pdf' => 'nullable|mimes:pdf|max:51200',
            'description' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('releases/images', 'public');
        }

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('releases/pdfs', 'public');
        }

        LatestRelease::create($data);

        return redirect()->route('admin.latest-releases.index')->with('success', 'Release created successfully.');
    }

    public function edit(LatestRelease $latestRelease)
    {
        return view('admin.latest_releases.edit', compact('latestRelease'));
    }

    public function update(Request $request, LatestRelease $latestRelease)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'pdf' => 'nullable|mimes:pdf|max:51200',
            'description' => 'nullable|string',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($latestRelease->image_path) {
                Storage::disk('public')->delete($latestRelease->image_path);
            }
            $data['image_path'] = $request->file('image')->store('releases/images', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($latestRelease->pdf_path) {
                Storage::disk('public')->delete($latestRelease->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf')->store('releases/pdfs', 'public');
        }

        $latestRelease->update($data);

        return redirect()->route('admin.latest-releases.index')->with('success', 'Release updated successfully.');
    }

    public function destroy(LatestRelease $latestRelease)
    {
        $latestRelease->update(['status' => !$latestRelease->status]);

        $status = $latestRelease->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.latest-releases.index')->with('success', "Release {$status} successfully.");
    }
}
