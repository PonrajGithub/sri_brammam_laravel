<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
        'pdf_path',
        'category_id',
        'creator_id',
        'read_time',
        'is_editors_pick',
        'view_count',
        'status'
    ];

    protected $casts = [
        'is_editors_pick' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }
}
