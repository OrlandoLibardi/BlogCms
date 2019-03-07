<?php

namespace OrlandoLibardi\BlogCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogAuthorRequest extends FormRequest
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
                    'name'  => 'required|string|max:255',
                    'email' => 'required|email|unique:blog_authors,email',                    
                    'photo' => 'sometimes|max:255',
                    ];   
            break;    
            case 'PUT':
            case 'PATCH':
                $rules = [
                    'name'  => 'sometimes|required|string|max:255',
                    'email' => 'sometimes|required|email|unique:blog_authors,email,' . $this->id,                    
                    'photo' => 'sometimes|max:255',
                    ]; 
            break;
            case 'DELETE':
                $rules = [
                    'id.*' => 'required|exists:blog_authors,id' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    }
    
}
