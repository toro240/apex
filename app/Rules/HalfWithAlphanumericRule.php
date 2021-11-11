<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HalfWithAlphanumericRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return preg_match("/^[a-zA-Z0-9]+$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must only contain alpha and numbers.';
    }
}
