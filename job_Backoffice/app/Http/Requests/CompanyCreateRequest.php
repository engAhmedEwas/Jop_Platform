<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255|unique:companies,name',
            'address'=>'required|string|max:255',
            'industry'=>'required|string|max:255',
            'website'=>'nullable|string|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'The Company Name Felid Is Required!',
            'name.unique'=>'The Company Name Has Already Been Taken!',
            'name.max'=>'The Company Name Must Be less Than 255 Character',
            'name.string'=>'The Company Name Must Be A String',

            'address.required'=>'The Company Name Felid Is Required!',
            'address.max'=>'The Company Name Must Be less Than 255 Character',
            'address.string'=>'The Company Name Must Be A String',

            'industry.required'=>'The Company Name Felid Is Required!',
            'industry.max'=>'The Company Name Must Be less Than 255 Character',
            'industry.string'=>'The Company Name Must Be A String',

            'website.url'=>'The Company Website Must Be Have A Valid URL!',
            'website.max'=>'The Company Name Must Be less Than 255 Character',
            'website.string'=>'The Company Name Must Be A String',
        ];
    }
}
