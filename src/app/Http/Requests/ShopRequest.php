<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'title' => 'required',
            'area_id' => 'required',
            'genre_id' => 'required',
            'information' => 'required|min:50|max:120',
            'image' => 'required'
        ];

    }

    public function messages()
    {
        return[
            'title.required' => '店舗名を入力してください',
            'area_id.required' => '地域を選択してください',
            'genre_id.required' => 'ジャンルを選択してください',
            'information.required' => '店舗概要を入力してください',
            'information.min' => '店舗概要は50字以上で入力してください',
            'information.max' => '店舗概要は120字以内で入力してください',
            'image.required' => '画像を選択してください',
        ];
    }
}
