<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePortfolioRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|url',
            'user_id' => 'required|exists:users,id',
            'created_by' => 'required|exists:users,id',   
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
        'user_id' => Auth::id(),
        'created_by' => Auth::id(),
        ]);
    }
}
