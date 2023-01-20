<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'description'=>['string'],
                'userId'=>['string','required'],
                'categoryId'=>['string','required'],
                'price'=>['integer','required'],
                'title'=>['string','required'],
            ];
        } elseif ($this->method() == 'PUT') {
            return [
                'uniqueId' => ['required', 'string'],
                'description' => ['string'],
                'categoryId' => ['string'],
                'price' => ['integer'],
                'title' => ['string'],
            ];
        } elseif ($this->method() == 'GET') {
            return [
                'uniqueId' => ['string'],
                'search' => ['string'],
                'price' => ['integer'],
                'title' => ['string'],
            ];
        } elseif ($this->method() == 'DELETE') {
            return[
                'uniqueId' => ['string', 'required'],
            ];
        }
    }
}
