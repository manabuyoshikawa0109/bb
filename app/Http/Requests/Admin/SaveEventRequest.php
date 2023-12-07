<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'events.*.type'              => ['required', Rule::in(Type::values())],
            'events.*.name'              => ['required', 'string', 'max:100'],
            'events.*.capacity'          => ['nullable', 'integer', 'min:0'],
            'events.*.participation_fee' => ['nullable', 'integer', 'min:0', 'digits_between:1,5'],
            'events.*.start_time'        => ['nullable', 'date_format:h:i'],
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
            'events.*.type'              => '種別',
            'events.*.name'              => '種目名',
            'events.*.capacity'          => '募集数',
            'events.*.participation_fee' => '参加費',
            'events.*.start_time'        => '開催時間',
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
