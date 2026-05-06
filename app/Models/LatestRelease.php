<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LatestRelease extends Model
{
    protected $fillable = ['title', 'image_path', 'pdf_path', 'description'];
}
