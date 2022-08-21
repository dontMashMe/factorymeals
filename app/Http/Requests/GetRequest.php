<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Language;

class GetRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
            'lang' => [
                'required',
                'size:2',
                'string',
                'exists:languages,locale'
            ]
        ];
    }

    public function messages()
    {
        return [
            'lang.required' => "Please enter a 'lang' param value.",
            'lang.size'     => "Lang param has to be 2 characters long.",
            'lang.string'   => "Lang param must be characters only.",
            'lang.size'     => "Lang param must be one of: ".implode(",", Language::GetLocales()),
        ];
    }
}
