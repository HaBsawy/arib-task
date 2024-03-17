<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends FormRequest
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
        return [
            'first_name'    => 'required|between:2,255',
            'last_name'     => 'required|between:2,255',
            'salary'        => 'required|numeric|between:0,999999.99',
            'email'         => 'required|max:255|email|unique:employees,email',
            'phone'         => 'required|digits:11|unique:employees,phone',
            'password'      => [
                'required', Password::min(8)->symbols()->numbers()->letters()->mixedCase()
            ],
            'manager_id'    => [
                'required',
                Rule::exists('employees', 'id')->where('type', 'manager')
            ],
            'department_id' => 'required|exists:departments,id',
            'image'         => 'image|max:2048'
        ];
    }

    private function getPutValidationRules(): array
    {
        $employee_id = $this->route('employee')->id;
        return [
            'first_name'    => 'required|between:2,255',
            'last_name'     => 'required|between:2,255',
            'salary'        => 'required|numeric|between:0,999999.99',
            'email'         => 'required|max:255|email|unique:employees,email,' . $employee_id,
            'phone'         => 'required|digits:11|unique:employees,phone,' . $employee_id,
            'password'      => [
                'nullable', Password::min(8)->symbols()->numbers()->letters()->mixedCase()
            ],
            'manager_id'    => [
                'required',
                Rule::exists('employees', 'id')->where('type', 'manager')
            ],
            'department_id' => 'required|exists:departments,id',
            'image'         => 'image|max:2048'
        ];
    }
}
