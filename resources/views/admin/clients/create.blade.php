@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Add New Client</h1>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">Client Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="client_logo">Client Logo (Max 10MB)</label>
            <input type="file" name="client_logo" id="client_logo" class="form-control" accept="image/*">
            @error('client_logo')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Client</button>
    </form>
</div>
@endsection
