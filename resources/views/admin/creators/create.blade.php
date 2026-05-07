@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Create Writer</h1>
    <a href="{{ route('admin.creators.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.creators.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="profile_image">Profile Image (Optional - Max 10MB)</label>
            <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
            @error('profile_image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="bio">Bio (Optional)</label>
            <textarea name="bio" id="bio" class="form-control" rows="4">{{ old('bio') }}</textarea>
            @error('bio')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" name="is_top_writer" id="is_top_writer" value="1" {{ old('is_top_writer') ? 'checked' : '' }}>
            <label for="is_top_writer" style="margin-bottom: 0;">Is Top Writer</label>
        </div>

        <button type="submit" class="btn btn-primary">Save Writer</button>
    </form>
</div>
@endsection
