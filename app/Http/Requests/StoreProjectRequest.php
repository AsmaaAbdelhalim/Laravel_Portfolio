<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
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
            'description' => 'required|string',
            'url' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'images' => 'nullable|array', 
            'images.*.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            //'images.*.image_name' => 'required|string|max:255',
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
