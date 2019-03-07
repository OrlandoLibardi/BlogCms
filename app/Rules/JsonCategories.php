<?php

namespace OrlandoLibardi\BlogCms\app\Rules;

use Illuminate\Contracts\Validation\Rule;
use OrlandoLibardi\BlogCms\app\BlogCategory;

class JsonCategories implements Rule
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
        
        $value = json_decode($value);
        $total = count($value);

        if($total==0){
            return false;
        }

        $encontrado = 0;
        foreach($value as $v){
            if(BlogCategory::find($v)){
                $encontrado++;
            }
        }

        return $total === $encontrado;

    }
    public function message()
    {
        return 'A categoria não existe!';
    }
}