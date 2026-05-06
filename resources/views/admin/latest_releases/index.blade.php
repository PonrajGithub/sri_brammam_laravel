@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Latest Releases</h1>
    <a href="{{ route('admin.latest-releases.create') }}" class="btn btn-primary">Add New Release</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>PDF</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($releases as $release)
                <tr>
                    <td>{{ $release->id }}</td>
                    <td>
                        @if($release->image_path)
                            <img src="{{ asset('storage/' . $release->image_path) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No image</span>
                        @endif
                    </td>
                    <td>{{ $release->title }}</td>
                    <td>
                        @if($release->pdf_path)
                            <a href="{{ asset('storage/' . $release->pdf_path) }}" target="_blank" style="color: var(--primary-color);">View PDF</a>
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No PDF</span>
                        @endif
                    </td>
                    <td>{{ $release->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.latest-releases.edit', $release) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.latest-releases.destroy', $release) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">No releases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
