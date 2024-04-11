<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'author' => ['required', 'string', 'max:50'],
            'book_publisher' => ['required', 'string', 'max:30'],
            'edition' => ['required', 'integer'],
            'volume' => ['required', 'integer'],
            'year' => ['required', 'integer'],
            'number_of_copies' => ['required', 'integer', 'min:1'],
            'number_of_reference_book' => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $numberOfCopies = $this->input('number_of_copies');
                    if ($value > $numberOfCopies) {
                        $fail('O campo Número de Livros de Referência deve ser menor que o campo Número de Cópias.');
                    }
                }
            ],
            'ISBN' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (strlen(strval($value)) != 10 && strlen(strval($value)) != 13) {
                        $fail('O campo ' . $attribute . ' deve possuir 10 ou 13 dígitos.');
                    }
                },
                'unique:book'
            ]
        ];
    }
}
