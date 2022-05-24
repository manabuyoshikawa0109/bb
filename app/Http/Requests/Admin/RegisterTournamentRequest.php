<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\ModelItems\Tournament\Status;

class RegisterTournamentRequest extends FormRequest
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
             'event_id'      => ['required', 'exists:events,id'],
             'place_id'      => ['required', 'exists:places,id'],
             'date'          => ['required', 'date', 'after_or_equal:today'], // 今日か、それ以降の日付
             'applicants'    => ['required', 'integer'],
             'entry_fee'     => ['required', 'digits_between:1,5'],
             'start_hour'    => ['required', 'between:0,23'],
             'start_minutes' => ['required', Rule::in($minutes)],
             'status_id'     => ['nullable', Rule::in(array_keys(Status::$items))],
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
             'event_id'      => '種目名',
             'place_id'      => '場所',
             'date'          => '開催日',
             'applicants'    => '募集数',
             'entry_fee'     => '参加費',
             'start_hour'    => '開始時間',
             'start_minutes' => '開始分',
             'status_id'     => '状態',
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
             'required'            => ':attributeは必須です',
             'exists'              => ':attributeの形式が不正です',
             'date'                => ':attributeの形式が不正です',
             'integer'             => ':attributeの形式が不正です',
             'in'                  => ':attributeの形式が不正です',
             'between'             => ':attributeの形式が不正です',
             // 参考：https://zenn.dev/shimotaroo/articles/297f683d7497b8
             'date.after_or_equal' => '開催日には、今日以降の日付を指定してください。',
         ];
     }
}
