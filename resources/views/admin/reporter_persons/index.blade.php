@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Reporter Persons</h1>
    <a href="{{ route('admin.reporter-persons.create') }}" class="btn btn-primary">Add New Person</a>
</div>

<div class="table-container glass">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Reporter</th>
                <th>Role</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($persons as $person)
                <tr>
                    <td>{{ $person->id }}</td>
                    <td>
                        @if($person->profile_image)
                            <img src="{{ asset('storage/' . $person->profile_image) }}" alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                        @else
                            <span style="color: #64748b; font-size: 0.875rem;">No image</span>
                        @endif
                    </td>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->reporter->name ?? 'N/A' }}</td>
                    <td>{{ $person->describe_role }}</td>
                    <td>{{ $person->mobile }}</td>
                    <td>
                        @if($person->status)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #22c55e; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Active</span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem;">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $person->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $person->updated_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.reporter-persons.edit', $person) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.reporter-persons.destroy', $person) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm {{ $person->status ? 'btn-danger' : 'btn-success' }}" style="{{ !$person->status ? 'background: #22c55e; border-color: #22c55e;' : '' }}">
                                {{ $person->status ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 2rem;">No reporter persons found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
