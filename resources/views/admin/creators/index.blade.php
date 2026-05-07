@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Top Writers</h1>
    <a href="{{ route('admin.creators.create') }}" class="btn btn-primary">Add New Writer</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Profile Image</th>
                <th>Name</th>
                <th>Bio</th>
                <th>Top Writer</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($creators as $creator)
                <tr>
                    <td>{{ $creator->id }}</td>
                    <td>
                        @if($creator->profile_image)
                            <img src="{{ asset('storage/' . $creator->profile_image) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No image</span>
                        @endif
                    </td>
                    <td>{{ $creator->name }}</td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $creator->bio }}
                    </td>
                    <td>
                        @if($creator->is_top_writer)
                            <span style="color: var(--primary-color); font-weight: bold;">Yes</span>
                        @else
                            <span style="color: #64748b;">No</span>
                        @endif
                    </td>
                    <td>
                        @if($creator->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $creator->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $creator->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.creators.edit', $creator) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.creators.destroy', $creator) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $creator->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$creator->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $creator->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 2rem;">No writers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
