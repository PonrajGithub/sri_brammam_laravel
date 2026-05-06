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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($videoUrls as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->title }}</td>
                    <td><a href="{{ $video->url }}" target="_blank" style="color: var(--primary-color);">View Link</a></td>
                    <td>{{ $video->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.video-urls.edit', $video) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.video-urls.destroy', $video) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">No video URLs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
