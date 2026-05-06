<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoUrl;
use App\Models\LatestRelease;

class ApiController extends Controller
{
    public function getVideoUrls()
    {
        $videoUrls = VideoUrl::latest()->get();
        return response()->json([
            'success' => true,
            'data' => $videoUrls
        ]);
    }

    public function getLatestReleases()
    {
        $releases = LatestRelease::latest()->get();
        
        // Map paths to full URLs
        $releases->transform(function ($release) {
            $release->image_url = $release->image_path ? asset('storage/' . $release->image_path) : null;
            $release->pdf_url = $release->pdf_path ? asset('storage/' . $release->pdf_path) : null;
            return $release;
        });

        return response()->json([
            'success' => true,
            'data' => $releases
        ]);
    }
}
