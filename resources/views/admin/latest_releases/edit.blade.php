@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Edit Release</h1>
    <a href="{{ route('admin.latest-releases.index') }}" class="btn" style="background: rgba(255,255,255,0.1); color: white;">Back</a>
</div>

<div class="glass" style="padding: 2rem; max-width: 800px;">
    <form action="{{ route('admin.latest-releases.update', $latestRelease) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $latestRelease->title) }}" required>
            @error('title')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Image Upload (Max 10MB - 841 x 1268)</label>
            @if($latestRelease->image_path)
                <div style="margin-bottom: 1rem;">
                    <img src="{{ asset('storage/' . $latestRelease->image_path) }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                </div>
            @endif
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            <small style="color: #94a3b8; display: block; margin-top: 0.25rem;">Leave blank to keep current image</small>
            @error('image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="pdf">PDF Upload (Max 50MB)</label>
            @if($latestRelease->pdf_path)
                <div style="margin-bottom: 1rem;">
                    <a href="{{ asset('storage/' . $latestRelease->pdf_path) }}" target="_blank" style="color: var(--primary-color);">View Current PDF</a>
                </div>
            @endif
            <input type="file" id="pdf" name="pdf" class="form-control" accept="application/pdf">
            <small style="color: #94a3b8; display: block; margin-top: 0.25rem;">Leave blank to keep current PDF</small>
            @error('pdf')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control rich-text">{{ old('description', $latestRelease->description) }}</textarea>
            @error('description')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Release</button>
    </form>
</div>
@endsection
