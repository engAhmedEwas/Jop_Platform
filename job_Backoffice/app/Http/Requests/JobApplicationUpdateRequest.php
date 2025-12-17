<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationUpdateRequest extends FormRequest
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
            'status' => 'bail|required|string|in:pending,accepted,rejected',

        ];
    }

    public function messages(): array
    {
        return [
            'status.required'=>'The Job Vacancy Name Felid Is Required!',
            'status.string'=>'The Job Vacancy Name Must Be A String',
            'status.in'=>"The Job Application Status Must To Be Either pending, accepted And rejected",
        ];
    }
}
