<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'post_id' => 'required|integer|exists:posts,id',
            'parent_id' => 'integer|exists:comments,id',
        ];
    }
}
