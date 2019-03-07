<?php

namespace OrlandoLibardi\BlogCms\app\Rules;

use Illuminate\Contracts\Validation\Rule;
use OrlandoLibardi\BlogCms\app\BlogCategory;

class ParentCategories implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value == 0 || is_null($value)) {
            return true;
        } else {
            return BlogCategory::find($value);
        }

    }
    public function message()
    {
        return 'A categoria parent é inválida.';
    }
}