<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' => [Rule::unique('projects', 'title')->ignore($this->project), 'max:150'],
            'content' =>'nullable|min:8',
            'cover' =>[ Rule::unique('technologies', 'cover')->ignore($this->project), 'max:1400' , 'image'],
            'link' =>'max:255|min:4',
            'source' =>'max:255|min:4',
            'type_id' => ['exists:types,id']
    ];
    }
}
