<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->request->get("id");
        return [
            "name" => "required|min:3",
            "email" => "required|email|unique:App\Models\User,email,$id",
            //"password" => "required|sometimes|string|min:5|confirmed",

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'email.required' => 'A message is required',
        ];
    }
}
