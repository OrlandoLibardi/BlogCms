<?php

namespace OrlandoLibardi\BlogCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use OrlandoLibardi\BlogCms\app\Rules\JsonCategories;
use OrlandoLibardi\BlogCms\app\Rules\DateBlog;

class BlogRequest extends FormRequest
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
                    'title'         => 'required|string|max:255',
                    'content'       => 'required',
                    'categories'    => [new JsonCategories($this->categories)],
                    'photo'         => 'nullable',
                    'author'        => 'required|exists:blog_authors,id',
                    'published_at'  => 'nullable|date_format:d/m/Y',
                    'unpublished_at' => 'nullable|date_format:d/m/Y',
                    'meta_title'    => 'required|string|max:90',
                    'meta_description' => 'required|string|max:160'
                ];   
            break;    
            case 'PUT':
                $rules = [
                    'title'         => 'required|string|max:255',
                    'content'       => 'required',
                    'categories'    => [new JsonCategories($this->categories)],
                    'photo'         => 'nullable',
                    'author'        => 'required|exists:blog_authors,id',
                    'published_at'  => 'nullable|date_format:d/m/Y',
                    'unpublished_at' => 'nullable|date_format:d/m/Y',
                    'meta_title'    => 'required|string|max:90',
                    'meta_description' => 'required|string|max:160'
                ]; 
            break;
            case 'PATCH':
            $rules = [
                'status'         => 'sometimes|min:0|max:1',
                'featured'       => 'sometimes|min:0|max:1'
            ]; 
            break;
            case 'DELETE':
                $rules = [
                    'id.*' => 'required|exists:blog,id' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    
    }
    
}
