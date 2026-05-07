@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add New Category</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Featured</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No image</span>
                        @endif
                    </td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->is_featured)
                            <span style="color: var(--primary-color); font-weight: bold;">Yes</span>
                        @else
                            <span style="color: #64748b;">No</span>
                        @endif
                    </td>
                    <td>
                        @if($category->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $category->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$category->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $category->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem;">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
