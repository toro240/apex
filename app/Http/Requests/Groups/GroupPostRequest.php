<?php

namespace App\Http\Requests\Groups;

use App\Models\Group;
use App\Rules\HalfWithAlphanumericRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class GroupPostRequest extends FormRequest
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
    #[ArrayShape(['name' => "string[]", 'userName.*' => "\App\Rules\HalfWithAlphanumericRule[]"])] public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:' . Group::MAX_NAME_LENGTH,
            ],
            'userName.*' => [
                new HalfWithAlphanumericRule(),
            ],
        ];
    }
}
