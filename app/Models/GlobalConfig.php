<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalConfig extends Model
{
    protected $fillable = ['year', 'issue', 'reader', 'short_about_us', 'long_about_us', 'login_url'];
}
