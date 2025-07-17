<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAboutRequest extends FormRequest
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
        'first_name' => 'required|min:3',
        'last_name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'job' => 'nullable|string|max:255',
        'degree' => 'nullable|string|max:255',
        'experience' => 'nullable|string',
        'birth_date' => 'nullable|date',
        'city' => 'nullable|string',
        'country' => 'nullable|string',

        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',

        //link https requiers
        'facebook' => 'nullable|string|max:255|url|starts_with:https://',
        'twitter' => 'nullable|string|max:255|url|starts_with:https://',
        'linkedin' => 'nullable|string|max:255|url|starts_with:https://',
        'instagram' => 'nullable|string|max:255|url|starts_with:https://',
        'github' => 'nullable|string|max:255|url|starts_with:https://',
        'youtube' => 'nullable|string|max:255|url|starts_with:https://',
        'website' => 'nullable|string|max:255|url|starts_with:https://',

        //social links
        'social_links' => 'nullable|array',
        'social_links.*.platform' => 'nullable|string',
        'social_links.*.url' => 'nullable|url',
        'social_links.*.icon' => 'nullable|string',

        'updated_by' => 'required|array',
        'updated_by.*.id' => 'required|exists:users,id',
        'updated_by.*.updated_at' => 'required|date',

        'user_id' => 'required|exists:users,id',

        //files        
        'header_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'cv' => 'nullable|file|mimes:pdf|max:10485760',
        ];
    }



    protected function prepareForValidation(): void
{
    $existing = $this->about?->updated_by ?? [];

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