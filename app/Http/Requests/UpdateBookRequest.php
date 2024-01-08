<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateBookRequest extends FormRequest
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
            'title' => ['required', 'min:1', 'max:255', 'string'],
            'author' => ['required', 'min:1', 'max:80', 'string'],
            'published_date' => ['required', 'date_format:d/m/Y'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(

            response()->json([
            'status'   => false,
            'message'   => 'Erro de Validação',
            'data'      => $validator->errors()
        ]),400);
    }
}
