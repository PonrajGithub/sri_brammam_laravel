<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Creator extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'profile_image',
        'bio',
        'is_top_writer',
        'status'
    ];

    protected $casts = [
        'is_top_writer' => 'boolean',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
