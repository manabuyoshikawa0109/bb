<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterPlaceRequest extends FormRequest
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
            'places'                     => ['required', 'array'],
            'places.*'                   => ['required', 'array'],
            'places.*.name'              => ['required', 'string', 'max:100'],
            'places.*.official_site_url' => ['nullable', 'string', 'max:255'],
            'places.*.google_map_url'    => ['nullable', 'string', 'max:255'],
            'places.*.delete'            => ['nullable', 'boolean'],
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
            'places'                     => '場所',
            'places.*'                   => '場所',
            'places.*.name'              => '場所名',
            'places.*.official_site_url' => '公式サイトURL',
            'places.*.google_map_url'    => 'GoogleマップのURL',
            'places.*.delete'            => '削除',
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
