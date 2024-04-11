<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        $id = unserialize($this->route('member'));
        
        return [
            'full_name' => ['required', 'string', 'max:50'],
            'id_member_type' => ['required', 'integer'],
            'email' => ['nullable', 'string', 'email', 'max:50', 'unique:user,email',
                Rule::unique((new Member())->getTable())->ignore($id)],
            'phone' => ['nullable', 'integer', Rule::unique((new Member())->getTable())->ignore($id)],
            'cpf' => ['nullable', 'digits:11', 'unique:user,cpf',
                Rule::unique((new Member())->getTable())->ignore($id)]
        ];
    }
}
