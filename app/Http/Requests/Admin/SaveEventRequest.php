<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Event\ApplicableSex;
use App\Enums\Event\Type;

class SaveEventRequest extends FormRequest
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
        // integerは整数かどうかをチェック。「-1」を通すので注意
        return [
            'name'           => ['required', 'string', 'max:100'],
            'type'           => ['required', Rule::in(Type::values())],
            'applicable_sex' => ['required', Rule::in(ApplicableSex::values())],
            'applicants'     => ['nullable', 'integer', 'min:0'],
            'entry_fee'      => ['nullable', 'integer', 'min:0', 'digits_between:1,5'],
            'start_time'     => ['nullable', 'date_format:h:i'],
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
            'name'           => '種目名',
            'type'           => '種別',
            'applicable_sex' => '申し込み可能な性別',
            'applicants'     => '募集数',
            'entry_fee'      => '参加費',
            'start_time'     => '開催時間',
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
