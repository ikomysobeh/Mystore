<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        if ($this->method() == 'POST'||$this->method() == 'DELETE') {
            return [
                "uniqueId"=>['string','required'],
                "permissionName"=>['string','required'],
            ];
        } elseif ($this->method() == 'PUT') {
            return [
                "uniqueId"=>['string','required'],
                "oldRoleName"=>['string','required'],
                "newRole"=>['string','required'],
            ];
        } elseif ($this->method() == 'GET') {
            return [
                "uniqueId"=>['string','required'],
            ];
        }
    }
}
