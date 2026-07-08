<?php

namespace App\Modules\Doctor\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'user_id' => 'exists:users,id',
            'qualification' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'specialization' => 'nullable|string|max:255',
            'consultation_fee' => 'nullable|numeric|min:0',
        ];
    }
}
