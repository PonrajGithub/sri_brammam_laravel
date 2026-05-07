@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Reporters</h1>
    <a href="{{ route('admin.reporters.create') }}" class="btn btn-primary">Add New Reporter</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reporters as $reporter)
                <tr>
                    <td>{{ $reporter->id }}</td>
                    <td>{{ $reporter->name }}</td>
                    <td>
                        @if($reporter->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $reporter->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $reporter->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.reporters.edit', $reporter) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.reporters.destroy', $reporter) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $reporter->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$reporter->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $reporter->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">No reporters found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
