@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Create Post</h1>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="creator_id">Writer</label>
            <select name="creator_id" id="creator_id" class="form-control" required>
                <option value="">Select Writer</option>
                @foreach($creators as $creator)
                    <option value="{{ $creator->id }}" {{ old('creator_id') == $creator->id ? 'selected' : '' }}>{{ $creator->name }}</option>
                @endforeach
            </select>
            @error('creator_id')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Featured Image (Optional - Max 10MB - 841 x 1268)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="pdf">PDF File (Optional - Max 50MB)</label>
            <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
            @error('pdf')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
            @error('description')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="read_time">Read Time (minutes)</label>
            <input type="number" name="read_time" id="read_time" class="form-control" value="{{ old('read_time', 0) }}" min="0" required>
            @error('read_time')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" name="is_editors_pick" id="is_editors_pick" value="1" {{ old('is_editors_pick') ? 'checked' : '' }}>
            <label for="is_editors_pick" style="margin-bottom: 0;">Is Editor's Pick</label>
        </div>

        <button type="submit" class="btn btn-primary">Save Post</button>
    </form>
</div>
@endsection
