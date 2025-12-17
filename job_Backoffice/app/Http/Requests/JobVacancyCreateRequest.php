<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class JobVacancyCreateRequest extends FormRequest
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
        'title'           => 'required|string|max:255',
        'location'        => 'required|string|max:255',
        'salary'          => 'required|numeric|min:0',
        'type'            => 'required|string|max:255',
        'description'     => 'required|string|max:255',
        'company_id'      => 'required|string|max:255',
        'jobCategory_id'  => 'required|string|max:255',
    ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'The Job Vacancy Name Felid Is Required!',
            'name.unique'=>'The Job Vacancy Name Has Already Been Taken!',
            'name.max'=>'The Job Vacancy Name Must Be less Than 255 Character',
            'name.string'=>'The Job Vacancy Name Must Be A String',

            'description.required'=>'The Job Vacancy Description Felid Is Required!',
            'description.max'=>'The Job Vacancy Description Must Be less Than 255 Character',
            'description.string'=>'The Job Vacancy Description Must Be A String',

            'location.required'=>'The Job Vacancy Location Felid Is Required!',
            'location.max'=>'The Job Vacancy Location Must Be less Than 255 Character',
            'location.string'=>'The Job Vacancy Location Must Be A String',

            'type.required'=>'The Job Vacancy Type Felid Is Required!',
            'type.max'=>'The Job Vacancy Type Must Be less Than 255 Character',
            'type.string'=>'The Job Vacancy Type Must Be A String',

            'salary.required'=>'The Owner Salary Felid Is Required!',
            'salary.max'=>'The Owner Salary Must Be less Than 255 Character',
            'salary.numeric'=>'The Owner Salary Must Be A Numeric',

            'company_id.required'=>'The Owner Company Felid Is Required!',
            'company_id.min'=>'The Owner Company Must Be Upper Than 8 Character',
            'company_id.string'=>'The Owner Company Must Be A String',

            'jobCategory_id.required'=>'The Owner Category Felid Is Required!',
            'jobCategory_id.email'=>'The Owner Category Must Be A Valid Email Address!',
            'jobCategory_id.unique'=>'The Owner Category Has Already Been Taken!',
        ];
    }
}
