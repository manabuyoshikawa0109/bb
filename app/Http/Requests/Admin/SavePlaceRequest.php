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
            'court_surface'     => ['nullable', 'string', 'max:100'],
            'official_site_url' => ['nullable', 'string', 'max:250', 'url'],
            'google_map_url'    => ['nullable', 'string', 'max:250', 'url'],
            // ファイルサイズのバリデーション単位はKB
            'file'              => ['nullable', 'image', 'mimes:' . config('admin.place.image.allowed_extension'), 'max:' . config('admin.place.image.max_sizes.kb')],
            'delete_image'      => ['required', 'boolean'],
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
            'court_surface'     => 'コートサーフェス',
            'official_site_url' => 'ホームページURL',
            'google_map_url'    => 'GoogleマップのURL',
            'file'              => '画像',
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
            // ファイルサイズのバリデーションメッセージはGB単位で出力
            'file.max' => ':attributeには、' . config('admin.place.image.max_sizes.gb') . 'GB以下のファイルを指定してください。',
        ];
    }
}
