<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CopieRequest extends FormRequest
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
        $id = unserialize($this->route('book'));

        return [
            'title' => ['required', 'string', 'max:50'],
            'author' => ['required', 'string', 'max:50'],
            'book_publisher' => ['required', 'string', 'max:30'],
            'edition' => ['required', 'integer'],
            'volume' => ['required', 'integer'],
            'year' => ['required', 'integer'],
            'copies' => ['nullable', 'integer', 'min:1'],
            'reference_books' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $numberOfCopies = $this->input('copies');
                    if ($value > $numberOfCopies) {
                        $fail('O campo Quantidade de Referência deve ser menor que o campo Quantidade de Cópias.');
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
                Rule::unique((new Book())->getTable())->ignore($id)
            ]
        ];
    }
}
