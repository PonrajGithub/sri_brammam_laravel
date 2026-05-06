@extends('layouts.admin')

@section('content')
<div class="header">
    <h1>Dashboard</h1>
</div>

<div class="grid">
    <div class="stat-card glass">
        <h3>{{ $releaseCount }}</h3>
        <p>Latest Releases</p>
    </div>
</div>
@endsection
