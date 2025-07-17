<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreQualificationRequest extends FormRequest
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
