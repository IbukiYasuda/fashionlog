<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'post.title' => 'required|string|max:100',
            'post.body' => 'required|string|max:4000',
            'image' => 'required|image'
        ];
    }
    
    public function messages()
{
    return [
        'post.title.required' => 'タイトルを入力してください',
        'post.body.required'  => '文章を入力してください',
        'image.required' => '画像を入れてください'
    ];
}
}
