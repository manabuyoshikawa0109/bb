<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegisterInformationRequest extends FormRequest
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
            'release_start_date' => ['required', 'date'],
            'release_end_date'   => ['nullable', 'date', 'after_or_equal:release_start_date'],
            'date'               => ['required', 'date'],
            'subject'            => ['required', 'string', 'max:100'],
            'body'               => ['nullable', 'string', 'max:1000'],
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
            'release_start_date' => '公開開始日',
            'release_end_date'   => '公開終了日',
            'date'               => '日付',
            'subject'            => '件名',
            'body'               => '本文',
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
            'required' => ':attributeは必須です',
            'date'     => ':attributeの形式が不正です',
        ];
    }
}
