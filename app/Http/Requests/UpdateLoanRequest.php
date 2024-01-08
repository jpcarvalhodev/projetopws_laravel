<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateLoanRequest extends FormRequest
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
            'issue_date' => ['required', 'date_format:d/m/Y'],
            'return_date' => ['required', 'date_format:d/m/Y', 'after:issue_date'],
            'student_id' => ['required', 'exists:students,id'],
            'book_id' => ['required', 'exists:books,id'],
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
