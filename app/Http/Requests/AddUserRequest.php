<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AddUserRequest extends FormRequest
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
            'name' => ['string', 'required'],
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'isMale' => ['boolean'],
        ];
    }
}
