<?php

namespace OrlandoLibardi\BlogCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use OrlandoLibardi\BlogCms\app\Rules\ParentCategories;

class BlogCategorieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'POST':
                $rules = [
                    'name'        => 'required|string|max:255',
                    'description' => 'max:255',
                    'parent_id'   => ['sometimes', new ParentCategories($this->parent_id)]
                    ];   
            break;    
            case 'PUT':
            case 'PATCH':
                $rules = [
                    'name'        => 'sometimes|required|string|max:255',
                    'description' => 'sometimes|max:255',
                    'parent_id'   => ['sometimes', new ParentCategories($this->parent_id)],
                    'status'      => 'sometimes|required|numeric|min:0|max:1',
                    'order_at'    => 'sometimes|required|numeric|min:1',
                    ]; 
            break;
            case 'DELETE':
                $rules = [
                    'id.*' => 'required|exists:blog_categories,id' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    }
    
}
