<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'is_featured',
        'status'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
