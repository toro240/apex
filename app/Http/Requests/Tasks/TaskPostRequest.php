<?php

namespace App\Http\Requests\Tasks;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class TaskPostRequest extends FormRequest
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
    #[ArrayShape(['subject' => "string[]", 'map' => "array", 'legend' => "array", 'contents' => "string[]", 'limitedAt' => "array", 'targetUser' => "array"])] public function rules(): array
    {
        return [
            'subject' => [
                'required',
                'max:' . Task::MAX_SUBJECT_LENGTH,
            ],
            'map' => [

            ],
            'legend' => [

            ],
            'contents' => [
                'required',
            ],
            'limitedAt' => [

            ],
            'targetUser' => [

            ],
        ];
    }
}
