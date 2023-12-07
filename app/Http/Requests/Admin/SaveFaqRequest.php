<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveFaqRequest extends FormRequest
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
        return [
            'ids'         => ['nullable', 'array'],
            'ids.*'       => ['nullable', 'exists:faqs,id'],
            'questions'   => ['required_with:ids', 'nullable', 'array'],
            'questions.*' => ['required_with:ids', 'nullable', 'string', 'max:100'],
            'answers'     => ['required_with:ids', 'nullable', 'array'],
            'answers.*'   => ['required_with:ids', 'nullable', 'string', 'max:500'],
        ];
    }

    /**
     * 属性名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'questions'   => '質問',
            'questions.*' => '質問',
            'answers'     => '回答',
            'answers.*'   => '回答',
        ];
    }

    /**
     * メッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required_with' => ':attributeは、必ず指定してください。',
        ];
    }
}