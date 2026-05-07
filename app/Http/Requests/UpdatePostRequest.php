<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'pdf' => 'nullable|mimes:pdf|max:51200',
            'category_id' => 'sometimes|required|exists:categories,id',
            'creator_id' => 'sometimes|required|exists:creators,id',
            'read_time' => 'integer|min:0',
            'is_editors_pick' => 'boolean',
        ];
    }
}
