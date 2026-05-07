@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Edit Reporter Person</h1>
    <a href="{{ route('admin.reporter-persons.index') }}" class="btn btn-primary" style="background: var(--text-color); color: var(--bg-color);">Back</a>
</div>

<div class="glass" style="padding: 2rem;">
    <form action="{{ route('admin.reporter-persons.update', $reporterPerson) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label class="form-label" for="reporter_id">Select Reporter</label>
            <select name="reporter_id" id="reporter_id" class="form-control" required>
                <option value="">Select Reporter</option>
                @foreach($reporters as $reporter)
                    <option value="{{ $reporter->id }}" {{ old('reporter_id', $reporterPerson->reporter_id) == $reporter->id ? 'selected' : '' }}>{{ $reporter->name }}</option>
                @endforeach
            </select>
            @error('reporter_id')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $reporterPerson->name) }}" required>
            @error('name')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="profile_image">Profile Image (Leave blank to keep current - Max 10MB)</label>
            @if($reporterPerson->profile_image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $reporterPerson->profile_image) }}" alt="Profile" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                </div>
            @endif
            <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
            @error('profile_image')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="describe_role">Describe Role</label>
            <input type="text" name="describe_role" id="describe_role" class="form-control" value="{{ old('describe_role', $reporterPerson->describe_role) }}">
            @error('describe_role')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label" for="mobile">Mobile (Optional)</label>
                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $reporterPerson->mobile) }}">
                    @error('mobile')
                        <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $reporterPerson->email) }}">
                    @error('email')
                        <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="address">Address (Optional)</label>
            <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $reporterPerson->address) }}</textarea>
            @error('address')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="pincode">Pincode (Optional)</label>
            <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode', $reporterPerson->pincode) }}">
            @error('pincode')
                <div style="color: #ef4444; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Person</button>
    </form>
</div>
@endsection
