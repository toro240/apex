<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\HalfWithAlphanumericRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ChangePasswordPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['password' => "string[]", 'confirmPassword' => "string[]"])] public function rules(): array
    {
        return [
            'password' => [
                'required',
                'min:' . User::MIN_PASSWORD_LENGTH,
                'max:' . User::MAX_PASSWORD_LENGTH,
                new HalfWithAlphanumericRule(),
            ],
            'confirmPassword' => [
                'required',
                'min:' . User::MIN_PASSWORD_LENGTH,
                'max:' . User::MAX_PASSWORD_LENGTH,
                new HalfWithAlphanumericRule(),
            ],
        ];
    }
}
