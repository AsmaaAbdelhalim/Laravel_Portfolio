<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'url' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'images' => 'nullable|array', 
            'images.*.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            //'images.*.image_name' => 'required|string|max:255',
            'updated_by' => 'required|array',
            'updated_by.*.id' => 'required|exists:users,id',
            'updated_by.*.updated_at' => 'required|date',
        ];
    }

    protected function prepareForValidation(): void
    {
        $existing = $this->project?->updated_by ?? [];
        $updatedBy = collect($existing)
        ->map(fn($item) => is_array($item) ? $item : ['id' => $item, 'updated_at' => now()->toDateTimeString()])
        ->keyBy('id')
        ->put(Auth::id(), ['id' => Auth::id(), 'updated_at' => now()->toDateTimeString()])
        ->values()
        ->all();
        
        $this->merge([
            'updated_by' => $updatedBy,
            'user_id' => Auth::id(),
        ]);  
    }
}
