<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContainListRule implements Rule
{
    private array $list;
    /**
     * Create a new rule instance.
     *
     * @param array $list
     * @return void
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (is_null($value)) {
            return true;
        }

        return isset($this->list[$value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must only contain lists.';
    }
}
