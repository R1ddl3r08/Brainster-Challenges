<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'phone' => ['required', 'numeric'],
            'company' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Ве молиме внесете мејл',
            'email.email' => 'Мејлот мора да биде валидна е-мејл адреса',
            'phone.required' => 'Ве молиме внесете телефонски број',
            'phone.numeric' => 'Телефонскиот број мора ра содржи само бројки',
            'company.required' => 'Ве молиме внесете го името на компанијата',
        ];
    }
}
