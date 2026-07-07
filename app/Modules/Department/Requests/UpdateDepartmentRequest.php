<?php

namespace App\Modules\Department\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $departmentId = $this->route('department');

        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:departments,code,' . $departmentId,
            'description' => 'nullable|string',
            'head_doctor_id' => 'nullable|exists:users,id',
            'phone' => 'nullable|string|max:20|unique:departments,phone,' . $departmentId,
            'email' => 'nullable|email|max:255|unique:departments,email,' . $departmentId,
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}
