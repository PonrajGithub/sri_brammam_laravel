@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Add New Issue</h1>
    <a href="{{ route('admin.latest-releases.index') }}" class="btn" style="background: rgba(255,255,255,0.1); color: white;">Back</a>
</div>

<div class="glass" style="padding: 2rem; max-width: 800px;">
    <form action="{{ route('admin.latest-releases.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Image Upload (Max 10MB - 841 x 1268)</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">
            @error('image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="pdf">PDF Upload (Max 50MB)</label>
            <input type="file" id="pdf" name="pdf" class="form-control" accept="application/pdf">
            @error('pdf')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control rich-text">{{ old('description') }}</textarea>
            @error('description')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Issue</button>
    </form>
</div>
@endsection
