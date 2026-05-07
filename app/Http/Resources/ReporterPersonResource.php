<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReporterPersonResource extends JsonResource
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
            'describe_role' => $this->describe_role,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'status' => (boolean) $this->status,
            'reporter' => new ReporterResource($this->whenLoaded('reporter')),
            'created_at' => $this->created_at,
        ];
    }
}
