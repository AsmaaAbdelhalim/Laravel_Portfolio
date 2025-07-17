<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateQualificationRequest extends FormRequest
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
            'type' => 'required|string',
            'title' => 'required|string',
            'association' => 'required|string',
            'description' => 'required|string',
            'from' => 'nullable|string',
            'to' => 'nullable|string',
            'updated_by' => 'required|array',
            'updated_by.*.id' => 'required|exists:users,id',
            'updated_by.*.updated_at' => 'required|date',
        ];
    }

    protected function prepareForValidation(): void
    {
        $existing = $this->qualification?->updated_by ?? [];
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
