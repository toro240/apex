<?php

namespace App\Http\Requests\Tasks;

use App\Models\Task;
use App\Rules\ContainListRule;
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
                new ContainListRule(Task::MAP),
            ],
            'legend' => [
                new ContainListRule(Task::LEGEND),
            ],
            'contents' => [
                'required',
                'max:' . Task::MAX_CONTENTS_LENGTH,
            ],
            'limitedAt' => [
                'nullable',
                'date' => 'date_format:Y-m-d',
            ],
        ];
    }
}
