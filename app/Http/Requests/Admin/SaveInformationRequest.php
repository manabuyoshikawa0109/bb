<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveInformationRequest extends FormRequest
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
        // dateバリデーションは「日」がなくても「時刻」があってもバリデーションを通ってしまう
        // 参考：https://qiita.com/kd9951/items/6514c4462fc0e0288afc
        return [
            'release_start_date' => ['nullable', 'date_format:Y-m-d'],
            'release_end_date'   => ['nullable', 'date_format:Y-m-d', 'after_or_equal:release_start_date'],
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
        return [];
    }
}
