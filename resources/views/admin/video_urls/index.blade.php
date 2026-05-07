@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Video URLs</h1>
    <a href="{{ route('admin.video-urls.create') }}" class="btn btn-primary">Add New Video</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>URL</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videoUrls as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->title }}</td>
                    <td><a href="{{ $video->url }}" target="_blank" style="color: var(--primary-color);">View Link</a></td>
                    <td>{{ $video->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $video->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        @if($video->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.video-urls.edit', $video) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.video-urls.destroy', $video) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $video->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$video->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $video->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">No video URLs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
