<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountAllExceptFiveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //validate that start is an integer less than 'end' and greater than or equal -10^9
            'start' => 'int|required|lt:end|gte:-1000000000',
            //validate that end is an integer and less than or equal 10^9
            'end' => 'int|required|lte:1000000000'
        ];
    }
}
