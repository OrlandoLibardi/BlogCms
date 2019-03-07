<?php

namespace OrlandoLibardi\BlogCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OrlandoLibardi\BlogCms\app\Rules\ParentComments;

class BlogCommentRequest extends FormRequest
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
                    'email'       => 'required|email',
                    'title'       => 'required|string|min:3|max:255',
                    'comment'     => 'required',
                    'parent_id'   => ['sometimes', new ParentComments($this->parent_id)]
                    ];   
            break;    
            case 'PUT':
                $rules = [
                    'name'        => 'sometimes|string|max:255',
                    'email'       => 'sometimes|email',
                    'title'       => 'sometimes|string|min:3|max:255',
                    'comment'     => 'sometimes',
                    'parent_id'   => ['sometimes', new ParentComments($this->parent_id)]
                ]; 
            break;
            case 'PATCH':
                $rules = [
                    'status'        => 'required|min:0|max:1'
                    ]; 
            break;
            case 'DELETE':
                $rules = [
                    'id.*' => 'required|exists:blog_comments,id' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    }
    
}
