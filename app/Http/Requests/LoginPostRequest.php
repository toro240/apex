<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\HalfWithAlphanumericSpCharRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginPostRequest extends FormRequest
{
    protected $redirect = '/login';
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
    #[ArrayShape(['name' => "string[]", 'password' => "string[]"])] public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:' . User::MAX_NAME_LENGTH,
                new HalfWithAlphanumericSpCharRule(),
            ],
            'password' => [
                'required',
                'min:' . User::MIN_PASSWORD_LENGTH,
                'max:' . User::MAX_PASSWORD_LENGTH,
                new HalfWithAlphanumericSpCharRule(),
            ],
        ];
    }
}
