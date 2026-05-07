@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Clients</h1>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Add New Client</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>
                        @if($client->client_logo)
                            <img src="{{ asset('storage/' . $client->client_logo) }}" alt="Logo" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No logo</span>
                        @endif
                    </td>
                    <td>{{ $client->name }}</td>
                    <td>
                        @if($client->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $client->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $client->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $client->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$client->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $client->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
