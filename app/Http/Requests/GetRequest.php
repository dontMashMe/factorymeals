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
            // accept any number, NULL or !NULL
            'category'  => 'regex:/(?i)(^([0-9]+|NULL|\!NULL)$)/',
            'diff_time' => 'integer',
            'with'      => 'in:ingredients,category,tags',
            'per_page'  => 'integer',
            'page'      => 'integer',
            'tags'      => 'array',
        
            'lang'      => [
                'required',
                'size:2',
                'string',
                'exists:languages,locale'
            ],
        ];
    }

    public function messages()
    {
        return [
            'lang.required'     => "Please enter a 'lang' param value.",
            'lang.size'         => "Lang param has to be 2 characters long.",
            'lang.string'       => "Lang param must be characters only.",
            'lang.exists'       => "Lang param must be one of: ".implode(",", Language::GetLocales()),
            'with.in'           => "Can only contain 'ingredients', 'category' or 'tags'",
            'per_page.integer'  => "Per_page param must be a number.",
            'page.integer'      => "Page param must be a number.",
            'tags.array'        => "Tags must be sent as a list. e.g &tags[]=1,2,3",
        ];
    }
}
