@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Add New Reporter</h1>
    <a href="{{ route('admin.reporters.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.reporters.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">Reporter Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="list_order">List Order</label>
            <input type="number" name="list_order" id="list_order" class="form-control" value="{{ old('list_order', 0) }}">
            @error('list_order')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Reporter</button>
    </form>
</div>
@endsection
