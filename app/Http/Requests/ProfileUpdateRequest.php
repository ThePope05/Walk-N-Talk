<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
    return [
        'name' => ['required','string','max:255'],
        'email' => ['required','email','max:255','unique:users,email,'.$this->user()->id],
        'full_name' => ['nullable','string','max:255'],
        'bio' => ['nullable','string','max:2000'],
        'avatar' => ['nullable','image','max:2048'], // 2MB
    ];
    }
}
