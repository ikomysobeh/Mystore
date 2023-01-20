<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'description'=>['string','required'],
                'name'=>['string','required'],
                'cover'=>['file', 'mimes:jpg', 'required'],
            ];
        } elseif ($this->method() == 'PUT') {
           return [
               'id' => ['required', 'numeric'],
               'name' => ['string'],
               'cover' => ['file', 'mimes:jpg'],
               'description'=>['string'],
           ];
        } elseif ($this->method() == 'GET') {
            return [
                'id' => [ 'numeric'],
                'name' => ['string', ],
                'search' => ['string', ],
            ];
        } elseif ($this->method() == 'DELETE') {
            return[
                'id' => ['numeric', 'required'],
            ];
        }
    }
}
