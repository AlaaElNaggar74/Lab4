<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|min:3',
            'logo' => 'required|unique:categories',
        ];
    }
    function message()
    {
        [
            "name.required" => "The name Is Required",
            "name.min" => "The name At Least 3 Char",

            "logo.required" => "The Image Source Is Required",
            // "logo.unique" => "The Image Source Used Before",
        ];
    }
}
