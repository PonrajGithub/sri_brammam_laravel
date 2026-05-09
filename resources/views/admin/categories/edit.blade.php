@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Edit Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label" for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Image (Leave blank to keep current - Max 10MB - 841 x 1268)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if($category->image)
                <div style="margin-top: 1rem;">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" style="max-width: 200px; border-radius: 8px;">
                </div>
            @endif
            @error('image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}>
            <label for="is_featured" style="margin-bottom: 0;">Is Featured</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
