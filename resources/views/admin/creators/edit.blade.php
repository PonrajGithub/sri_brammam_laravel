@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Edit Writer</h1>
    <a href="{{ route('admin.creators.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.creators.update', $creator) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $creator->name) }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="profile_image">Profile Image (Leave blank to keep current - Max 10MB)</label>
            <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
            @if($creator->profile_image)
                <div style="margin-top: 1rem;">
                    <img src="{{ asset('storage/' . $creator->profile_image) }}" alt="Current Image" style="max-width: 100px; border-radius: 8px;">
                </div>
            @endif
            @error('profile_image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="4">{{ old('bio', $creator->bio) }}</textarea>
            @error('bio')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" name="is_top_writer" id="is_top_writer" value="1" {{ old('is_top_writer', $creator->is_top_writer) ? 'checked' : '' }}>
            <label for="is_top_writer" style="margin-bottom: 0;">Is Top Writer</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Writer</button>
    </form>
</div>
@endsection
