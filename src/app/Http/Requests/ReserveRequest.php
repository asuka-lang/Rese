<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'user_id'=> 'required',
            'date'=> 'required|date|after:today',
            'time'=> 'required',
            'number'=> 'required'
        ];
    }

    public function messages()
    {
        return[
            'user_id.required'=>'会員登録・ログインが必須です',
            'date.required'=>'日付は必須です',
            'date.after'=>'日付は今日以降の日付で設定してください',
            'time.required' => '時間は必須です',
            'number.required'=>'人数入力は必須です'
        ];
    }
}
