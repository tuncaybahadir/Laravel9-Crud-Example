<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'birthdate' => 'required|date_format:d-m-Y',
            'gender' => 'required|in:0,1',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'İsim alanı zorunludur',
            'name.min' => 'İsim :min karakterden oluşmak zorundadır.',
            'birthdate.required' => 'Doğum günü alanı zorunlu',
            'birthdate.date_format' => 'Doğum günü formatı hatalı',
            'gender.required' => 'Cinsiyet Alanı Zorunlu',
            'gender.in' => 'Cinsiyet verisi hatalı',
        ];
    }
}
