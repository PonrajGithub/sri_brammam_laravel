<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brammam Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
    <!-- Using normal text box as requested -->
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar glass">
            <div style="text-align: center; margin-bottom: 2rem;">
                <img src="{{ asset('img/logo.svg') }}" alt="Brammam Logo" style="max-width: 100%; height: auto; max-height: 60px;">
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.video-urls.index') }}" class="{{ request()->routeIs('admin.video-urls.*') ? 'active' : '' }}">Video URLs</a></li>
                <li><a href="{{ route('admin.latest-releases.index') }}" class="{{ request()->routeIs('admin.latest-releases.*') ? 'active' : '' }}">Latest Releases</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a></li>
                <li><a href="{{ route('admin.creators.index') }}" class="{{ request()->routeIs('admin.creators.*') ? 'active' : '' }}">Top Writers</a></li>
                <li><a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">Posts</a></li>
                <li><a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">Clients</a></li>
                <li><a href="{{ route('admin.reporters.index') }}" class="{{ request()->routeIs('admin.reporters.*') ? 'active' : '' }}">Reporters</a></li>
                <li><a href="{{ route('admin.reporter-persons.index') }}" class="{{ request()->routeIs('admin.reporter-persons.*') ? 'active' : '' }}">Reporter Persons</a></li>
                <li style="margin-top: 2rem;">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="width: 100%;">Logout</button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success glass">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger glass">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
