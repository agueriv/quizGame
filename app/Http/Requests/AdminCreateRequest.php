<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
{
    // Definimos los campos que pueden llegar al request
    function attributes() {
        return [
            'username' => 'username',
            'password' => 'access password',
            'photo' => 'profile picture'
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
    
    function messages() {
        $required = 'The :attribute field is mandatory.';
        $min = 'The minimum length for the :attribute field is :min characters.';
        $max = 'The maximum length for the :attribute field is :max characters.';
        $string = 'The :attribute field must be a string.';
         
         return [
             'username.required' => $required,
             'username.string' => $string,
             'username.min' => $min,
             'username.max' => $max,
             'username.unique' => 'This user name is already registered.',
             'password.required' => $required,
             'password.string' => $string,
             'password.min' => $min,
             'password.max' => $max,
             'password.confirmed' => 'Passwords must be the same.',
             'photo.mimetypes' => 'The type of image uploaded is not allowed',
         ];
     }
    
    // reglas de validacion de admin
    public function rules(): array {
        return [
            'username' => 'required|string|min:3|max:100|unique:admin,username',
            'password' => 'required|string|min:6|max:80|confirmed', 
            'photo' => 'nullable|mimetypes:image/jpeg,image/png,image/bmp,image/svg,image/gif'
        ];
    }
}
