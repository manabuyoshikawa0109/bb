<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\ModelItems\Event\Type;
use Illuminate\Validation\Rule;

class RegisterEventRequest extends FormRequest
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
        $minutes = [];
        for($minute = 0; $minute <= 45; $minute+=15){
            $minute = sprintf('%02d', $minute);
            $minutes[] = $minute;
        }
        return [
            'events'                 => ['required', 'array'],
            'events.*'               => ['required', 'array'],
            'events.*.name'          => ['required', 'string', 'max:100'],
            'events.*.type_id'       => ['required', Rule::in(array_keys(Type::$items))],
            'events.*.applicants'    => ['nullable', 'integer'],
            'events.*.entry_fee'     => ['nullable', 'digits_between:1,5'],
            'events.*.start_hour'    => ['nullable', 'between:0,23'],
            'events.*.start_minutes' => ['nullable', Rule::in($minutes)],
            'events.*.delete'        => ['nullable', 'boolean'],
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
            'events'                 => '種目',
            'events.*'               => '種目',
            'events.*.name'          => '種目名',
            'events.*.type_id'       => '種別',
            'events.*.applicants'    => '募集数',
            'events.*.entry_fee'     => '参加費',
            'events.*.start_hour'    => '開始時間',
            'events.*.start_minutes' => '開始分',
            'events.*.delete'        => '削除',
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
            'array'    => ':attributeの形式が不正です',
            'integer'  => ':attributeの形式が不正です',
            'in'       => ':attributeの形式が不正です',
            'boolean'  => ':attributeの形式が不正です',
            'between'  => ':attributeの形式が不正です',
        ];
    }
}
