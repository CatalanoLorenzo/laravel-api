<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' =>[Rule::unique('types', 'name')->ignore($this->type), 'max:150'],
            'cover' =>[Rule::unique('types', 'cover')->ignore($this->type), 'max:700' ,'image'],
        ];
    }
}
