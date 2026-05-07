<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreatorController extends Controller
{
    public function index()
    {
        $creators = Creator::latest()->get();
        return view('admin.creators.index', compact('creators'));
    }

    public function create()
    {
        return view('admin.creators.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string',
            'is_top_writer' => 'boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'bio' => $validated['bio'] ?? null,
            'is_top_writer' => $request->has('is_top_writer'),
        ];

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('creators', 'public');
        }

        Creator::create($data);

        return redirect()->route('admin.creators.index')->with('success', 'Creator created successfully.');
    }

    public function edit(Creator $creator)
    {
        return view('admin.creators.edit', compact('creator'));
    }

    public function update(Request $request, Creator $creator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bio' => 'nullable|string',
            'is_top_writer' => 'boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'bio' => $validated['bio'] ?? null,
            'is_top_writer' => $request->has('is_top_writer'),
        ];

        if ($request->hasFile('profile_image')) {
            if ($creator->profile_image) {
                Storage::disk('public')->delete($creator->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('creators', 'public');
        }

        $creator->update($data);

        return redirect()->route('admin.creators.index')->with('success', 'Creator updated successfully.');
    }

    public function destroy(Creator $creator)
    {
        $creator->update(['status' => !$creator->status]);

        $status = $creator->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.creators.index')->with('success', "Creator {$status} successfully.");
    }
}
