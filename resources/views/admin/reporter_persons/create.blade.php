@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Add New Reporter Person</h1>
    <a href="{{ route('admin.reporter-persons.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.reporter-persons.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="reporter_id">Select Reporter</label>
            <select name="reporter_id" id="reporter_id" class="form-control" required>
                <option value="">Select Reporter</option>
                @foreach($reporters as $reporter)
                    <option value="{{ $reporter->id }}" {{ old('reporter_id') == $reporter->id ? 'selected' : '' }}>{{ $reporter->name }}</option>
                @endforeach
            </select>
            @error('reporter_id')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="describe_role">Describe Role</label>
            <input type="text" name="describe_role" id="describe_role" class="form-control" value="{{ old('describe_role') }}">
            @error('describe_role')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label" for="mobile">Mobile (Optional)</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
                    @error('mobile')
                        <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="address">Address (Optional)</label>
            <textarea name="address" id="address" class="form-control" rows="3">{{ old('address') }}</textarea>
            @error('address')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="pincode">Pincode (Optional)</label>
            <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode') }}">
            @error('pincode')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Person</button>
    </form>
</div>
@endsection
