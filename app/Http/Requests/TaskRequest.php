<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'employee_id'   => [
                'required',
                Rule::exists('employees', 'id')->where('type', 'employee')
            ],
            'name'          => 'required|between:3,255'
        ];
    }

    private function getPutValidationRules(): array
    {
        return ['status' => 'required|in:open,in progress,resolved'];
    }
}
