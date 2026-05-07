@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add New Post</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>PDF</th>
                <th>Category</th>
                <th>Creator</th>
                <th>Editor's Pick</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No image</span>
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if($post->pdf_path)
                            <a href="{{ asset('storage/' . $post->pdf_path) }}" target="_blank" style="color: var(--primary-color);">View PDF</a>
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No PDF</span>
                        @endif
                    </td>
                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                    <td>{{ $post->creator->name ?? 'N/A' }}</td>
                    <td>
                        @if($post->is_editors_pick)
                            <span style="color: var(--primary-color); font-weight: bold;">Yes</span>
                        @else
                            <span style="color: #64748b;">No</span>
                        @endif
                    </td>
                    <td>
                        @if($post->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $post->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $post->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $post->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$post->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $post->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align: center; padding: 2rem;">No posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
