<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
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
            'birthdate' => 'required|date_format:d/m/Y',
            'gender' => 'required|in:0,1',

            'city_name' => 'nullable|max:20',
            'post_code' => 'nullable|max:20',
            'address'   => 'nullable|max:255',
            'country_name' => 'nullable|max:30',

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

            'city_name.max' => 'Şehir Adı :max karakterden fazla uzunlukta olamaz',
            'post_code.max' => 'Şehir Posta Kodu :max karakterden fazla uzunlukta olamaz',
            'address.max' => 'Adres :max karakterden fazla uzunlukta olamaz',
            'country_name.max' => 'Ülke Adı :max karakterden fazla uzunlukta olamaz',
        ];
    }
}
