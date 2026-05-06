@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Edit Video URL</h1>
    <a href="{{ route('admin.video-urls.index') }}" class="btn" style="background: rgba(255,255,255,0.1); color: white;">Back</a>
</div>

<div class="glass" style="padding: 2rem; max-width: 600px;">
    <form action="{{ route('admin.video-urls.update', $videoUrl) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $videoUrl->title) }}" required>
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="url">Video URL</label>
            <input type="url" id="url" name="url" class="form-control" value="{{ old('url', $videoUrl->url) }}" required>
            @error('url')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Video</button>
    </form>
</div>
@endsection
