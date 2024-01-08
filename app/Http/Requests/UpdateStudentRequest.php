<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateStudentRequest extends FormRequest
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
            'name' => ['required', 'min:1', 'max:80', 'string'],
            'email' => ['required', 'min:1', 'max:30', 'string'],
            'birthdate' => ['required', 'date_format:d/m/Y'],
            'nif' => ['required', 'digits_between:1,9', 'integer'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(

            response()->json([
            'status'   => false,
            'message'   => 'Erro de Validação',
            'data'      => $validator->errors()
        ],400));
    }
}
