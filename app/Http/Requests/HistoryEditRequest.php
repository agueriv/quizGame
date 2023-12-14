<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryEditRequest extends FormRequest
{
    // Definimos los campos que pueden llegar al request
    function attributes() {
        return [
            'alias' => 'user alias',
            'escorrecta' => 'answered correctly'
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
             'alias.required' => $required,
             'alias.string' => $string,
             'alias.min' => $min,
             'alias.max' => $max,
             'escorrecta.required' => $required
         ];
     }
    
    // reglas de validacion de admin
    public function rules(): array {
        return [
            'alias' => 'required|string|min:3|max:100',
            'escorrecta' => 'required'
        ];
    }
}
