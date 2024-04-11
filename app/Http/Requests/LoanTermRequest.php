<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanTermRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'max_renovations' => ['required', 'integer', 'min:0'],
            'days_student' => ['required', 'integer', 'min:1'],
            'days_teacher' => ['required', 'integer', 'min:1']
        ];
    }
}
