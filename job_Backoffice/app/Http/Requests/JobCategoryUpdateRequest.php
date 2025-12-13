<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobCategoryUpdateRequest extends FormRequest
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
            'name'=>'bail|required|string|max:255' . $this->route('job-categories'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'The Category Name Felid Is Required!',
            'name.unique'=>'The Category Name Has Already Been Taken!',
            'name.max'=>'The Category Name Must Be less Than 255 Character',
            'name.string'=>'The Category Name Must Be A String',
        ];
    }
}
