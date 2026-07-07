<?php

namespace App\Modules\Department\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:departments,code',
            'description' => 'nullable|string',
            'head_doctor_id' => 'nullable|exists:users,id',
            'phone' => 'nullable|string|max:20|unique:departments,phone',
            'email' => 'nullable|email|max:255|unique:departments,email',
            'location' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ];
    }
}
