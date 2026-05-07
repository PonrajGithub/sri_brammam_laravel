<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'pdf' => $this->pdf_path ? asset('storage/' . $this->pdf_path) : null,
            'read_time' => $this->read_time,
            'is_editors_pick' => $this->is_editors_pick,
            'view_count' => $this->view_count,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'creator' => new CreatorResource($this->whenLoaded('creator')),
            'created_at' => $this->created_at,
        ];
    }
}
