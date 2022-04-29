<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
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
            'events.*.id'            => ['nullable', 'integer', 'exists:events'],
            'events.*.name'          => ['required', 'string', 'max:100'],
            'events.*.applicants'    => ['nullable', 'integer'],
            'events.*.entry_fee'     => ['nullable', 'integer'],
            'events.*.start_hour'    => ['nullable', 'between:0,23'],
            'events.*.start_minutes' => ['nullable', Rule::in($minutes)],
            'events.*.is_doubles'    => ['nullable', 'boolean'],
            'events.*.is_mix'        => ['nullable', 'boolean'],
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
            'events.*.applicants'    => '募集数',
            'events.*.entry_fee'     => '参加費',
            'events.*.start_hour'    => '開始時間',
            'events.*.start_minutes' => '開始分',
            'events.*.is_doubles'    => 'ダブルス',
            'events.*.is_mix'        => 'ミックス',
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
