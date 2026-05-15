<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'email' => 'required',
            'title' => 'required',
            'text' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'email.required' => '宛名を入力してください',
            'title.required' => '件名を入力してください',
            'text.required' => '本文を入力してください',
        ];
    }
}
