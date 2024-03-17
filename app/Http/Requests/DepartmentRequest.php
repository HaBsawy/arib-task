<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return $this->isMethod('POST') ?
            $this->getPostValidationRules() :
            $this->getPutValidationRules();
    }

    private function getPostValidationRules(): array
    {
        return ['name' => 'required|between:3,255|unique:departments,name'];
    }

    private function getPutValidationRules(): array
    {
        $department_id = $this->route('department')->id;
        return ['name' => 'required|between:3,255|unique:departments,name,' . $department_id];
    }
}
