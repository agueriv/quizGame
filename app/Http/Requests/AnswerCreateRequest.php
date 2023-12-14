<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerCreateRequest extends FormRequest
{
    function attributes() {
        return [
            'idquestion' => 'question id',
            'name' => 'answer name',
            'escorrecta' => 'answer status'
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
             'idquestion.required' => $required,
             'idquestion.int' => 'The :attribute field must be an integer.',
             'name.required' => $required,
             'name.string' => $string,
             'name.min' => $min,
             'name.max' => $max,
             'escorrecta.requried' => $required
         ];
     }
    
    // reglas de validacion de admin
    public function rules(): array {
        return [
            'idquestion' => 'required|int',
            'name' => 'required|string|min:1|max:200', 
            'escorrecta' => 'required'
        ];
    }
}
