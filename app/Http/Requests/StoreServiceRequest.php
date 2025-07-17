<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreServiceRequest extends FormRequest
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
            'icon' => 'required|string|max:255',
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
