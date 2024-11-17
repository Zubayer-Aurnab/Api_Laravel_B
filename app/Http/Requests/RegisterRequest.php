<?php

namespace App\Http\Requests;

use App\Http\Resources\ErrorResource;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     $response = (new ErrorResource($validator->errors()))->response()->setStatusCode(422);
    //     throw new ValidationException($validator, $response);
    // }
}
