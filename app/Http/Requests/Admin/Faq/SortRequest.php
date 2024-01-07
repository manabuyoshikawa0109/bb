<?php

namespace App\Http\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
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
            'ids'   => ['required', 'array'],
            'ids.*' => ['required', 'exists:faqs,id'],
        ];
    }

    /**
     * バリデータインスタンスの設定
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->fails()) {
            $validator->errors()->add('ids', '不正な操作が行われました。');
        }
    }

    /**
     * メッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ids.required' => '不正な操作が行われました。',
            'ids.array'    => '不正な操作が行われました。',
        ];
    }
}
