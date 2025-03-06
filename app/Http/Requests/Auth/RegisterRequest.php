<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name" => "required|string|min:2",
            "surname" => "required|string|min:2",
            "patronymic" => "string",
            'phone' => ['required', 'numeric', $this->uniqueMongo('phone')],
            'email' => ['required', 'email', $this->uniqueMongo('email')],
            "password" => "required|min:5",
            "password_confirmation" => "required|min:5|same:password"
        ];
    }

    protected function uniqueMongo($field)
    {
        return function ($attribute, $value, $fail) use ($field) {
            if (User::where($field, $value)->exists()) {
                $fail($attribute . ' has already been taken.');
            }
        };
    }
}
