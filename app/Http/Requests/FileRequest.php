<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
                'path'=>['file', 'mimes:jpg', 'required'],
                'postId'=>['string','required'],
            ];
        } elseif ($this->method() == 'PUT') {
            return [
                'uniqueId' => ['required', 'string'],
                'description' => ['string'],
                'postId' => ['string','required'],
                'path' => ['file', 'mimes:jpg'],
            ];
        } elseif ($this->method() == 'GET') {
            return [
                'uniqueId' => ['string','required'],
                'search' => ['string'],
            ];
        } elseif ($this->method() == 'DELETE') {
            return[
                'uniqueId' => ['string', 'required'],
            ];
        }
    }
}
