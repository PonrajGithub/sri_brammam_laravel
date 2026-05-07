<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name' => $this->name,
            'client_logo' => $this->client_logo ? asset('storage/' . $this->client_logo) : null,
            'status' => (boolean) $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
