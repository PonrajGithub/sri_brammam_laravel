<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use App\Http\Requests\StoreCreatorRequest;
use App\Http\Requests\UpdateCreatorRequest;
use App\Http\Resources\CreatorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreatorController extends Controller
{
    public function index(Request $request)
    {
        $creators = Creator::query();
        
        if ($request->has('search')) {
            $creators->where('name', 'like', '%' . $request->search . '%');
        }

        return CreatorResource::collection($creators->paginate(10));
    }

    public function store(StoreCreatorRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('creators', 'public');
        }

        $creator = Creator::create($data);

        return new CreatorResource($creator);
    }

    public function show(Creator $creator)
    {
        return new CreatorResource($creator);
    }

    public function update(UpdateCreatorRequest $request, Creator $creator)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($creator->profile_image) {
                Storage::disk('public')->delete($creator->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('creators', 'public');
        }

        $creator->update($data);

        return new CreatorResource($creator);
    }

    public function destroy(Creator $creator)
    {
        if ($creator->profile_image) {
            Storage::disk('public')->delete($creator->profile_image);
        }
        
        $creator->delete();

        return response()->json(['message' => 'Creator deleted successfully']);
    }
}
