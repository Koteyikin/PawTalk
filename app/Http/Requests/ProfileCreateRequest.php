<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileCreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'gender_id' => 'required|integer|exists:genders,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'interest' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'description' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id',
            'animal_id' => 'required|integer|exists:animals,id',
        ];
    }
}
