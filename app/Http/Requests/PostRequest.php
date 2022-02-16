<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

        if ($this->route()->action['as'] == 'post.reply') {
            $rule =  [
                'reply' => 'required|string|max:1000'
            ];
        } else if ($this->route()->action['as'] == 'post.comment') {
            $rule =  [
                'comment' => 'required|string|max:1000'
            ];
        } else {
            $rule =  [
                'category' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'body' => 'required|string|max:1000',
                'image' => 'mimes:png,jpg,jpeg,gif,svg',
            ];
        }

        return $rule;
        
    }
}
