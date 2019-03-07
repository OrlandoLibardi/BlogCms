<?php

namespace OrlandoLibardi\BlogCms\app\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateBlog implements Rule
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
        
        if($value == "" || is_null($value)) {
            return true;
        }
        if($value){
            $temp = date_format:d/m/Y
        }

    }
    public function message()
    {
        return 'A categoria não existe!';
    }
}