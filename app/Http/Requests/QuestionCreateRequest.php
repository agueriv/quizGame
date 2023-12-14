<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionCreateRequest extends FormRequest
{
    function attributes() {
        return [
            'name' => 'question name',
            'firstanswer' => 'first answer',
            'secondanswer' => 'second answer',
            'thirdanswer' => 'third answer',
            'fourthanswer' => 'fourth question',
            'correctanswer' => 'correct answer'
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
             'name.required' => $required,
             'name.string' => $string,
             'name.min' => $min,
             'name.max' => $max,
             'name.unique' => 'This question already exists',
             'firstanswer.required' => $required,
             'firstanswer.string' => $string,
             'firstanswer.min' => $min,
             'firstanswer.max' => $max,
             'secondanswer.required' => $required,
             'secondanswer.string' => $string,
             'secondanswer.min' => $min,
             'secondanswer.max' => $max,
             'thirdanswer.required' => $required,
             'thirdanswer.string' => $string,
             'thirdanswer.min' => $min,
             'thirdanswer.max' => $max,
             'fourthanswer.required' => $required,
             'fourthanswer.string' => $string,
             'fourthanswer.min' => $min,
             'fourthanswer.max' => $max,
             'correctanswer.required' => $required
         ];
     }
    
    // reglas de validacion de admin
    public function rules(): array {
        return [
            'name' => 'required|string|min:1|max:150|unique:question,name',
            'firstanswer' => 'required|string|min:1|max:200', 
            'secondanswer' => 'required|string|min:1|max:200',
            'thirdanswer' => 'required|string|min:1|max:200',
            'fourthanswer' => 'required|string|min:1|max:200',
            'correctanswer' => 'required'
        ];
    }
}
