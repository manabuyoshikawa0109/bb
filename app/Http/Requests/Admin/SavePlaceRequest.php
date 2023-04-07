<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SavePlaceRequest extends FormRequest
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
            'name'              => ['required', 'string', 'max:100'],
            'official_site_url' => ['nullable', 'string', 'max:250', 'url'],
            'google_map_url'    => ['nullable', 'string', 'max:250', 'url'],
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
            'name'              => '場所名',
            'official_site_url' => '公式サイトURL',
            'google_map_url'    => 'GoogleマップのURL',
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
        ];
    }
}
