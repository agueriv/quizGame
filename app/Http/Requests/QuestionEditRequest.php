<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionEditRequest extends QuestionCreateRequest
{
    public function rules(): array {
        $rules = parent::rules();
        $rules['name'] = 'required|string|min:3|max:150|unique:question,name,'.$this->question->id;
        return $rules;
    }
}
