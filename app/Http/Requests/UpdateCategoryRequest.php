<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'portfolio_id' => 'required|exists:portfolios,id',
            'updated_by' => 'required|array',
            'updated_by.*.id' => 'required|exists:users,id',
            'updated_by.*.updated_at' => 'required|date',
        ];
    }

    protected function prepareForValidation(): void
    {
      //$existing = $this->category?->updated_by ?? [];
      //$updatedBy = is_array($existing) ? $existing : (array) $existing;

    //$updatedBy = $this->input('updated_by', []);
    //$updatedBy = is_array($updatedBy) ? $updatedBy : (array) $updatedBy; // Ensure it's an array

        //$updatedBy[] = Auth::id();
        //$updatedBy = array_unique($updatedBy);
        
        $existing = $this->category?->updated_by ?? [];

    // Ensure it's an array of objects with id and updated_at
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