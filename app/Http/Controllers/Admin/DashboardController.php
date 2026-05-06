<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoUrl;
use App\Models\LatestRelease;

class DashboardController extends Controller
{
    public function index()
    {
        $releaseCount = LatestRelease::count();

        return view('admin.dashboard', compact('releaseCount'));
    }
}
