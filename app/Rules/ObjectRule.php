<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ObjectRule implements Rule
{

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
    public function passes($attribute, $value)
    {
        return is_object($value) || is_array($value);
    }

    public function message(): string
    {
        return 'Message must be an array or an object.';
    }
}
