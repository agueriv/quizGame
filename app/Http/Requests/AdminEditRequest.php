<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEditRequest extends AdminCreateRequest
{
    public function rules(): array {
        $rules = parent::rules();
        $rules['username'] = 'required|string|min:3|max:100|unique:admin,username,'.$this->admin->id;
        return $rules;
    }
}
