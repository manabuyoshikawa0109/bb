<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SaveTournamentRequest extends FormRequest
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
            'release_start_date' => ['nullable', 'date_format:Y-m-d'],
            'release_end_date'   => ['nullable', 'date_format:Y-m-d', 'after_or_equal:release_start_date'],
            'event_id'           => ['required', 'exists:events,id'],
            'place_id'           => ['required', 'exists:places,id'],
            'held_at'            => ['required', 'date_format:Y-m-d h:i:s'],
            'applicants'         => ['required', 'integer', 'min:0'],
            'entry_fee'          => ['required', 'integer', 'min:0', 'digits_between:1,5'],
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
            'event_id'           => '種目',
            'place_id'           => '場所',
            'held_at'            => '開催日時',
            'applicants'         => '募集数',
            'entry_fee'          => '参加費',
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