<?php
namespace App\Modules\Doctor\DTO;

class DoctorDTO{
    public function __construct(
        public readonly string $name,
        public readonly ?string $password =null,
        public readonly ?int $department_id = null,
        public readonly ?string $specialization =null,
        public readonly ?string $qualification =null,
        public readonly string $email,
        public readonly ?float $consultation_fee =null,
    ){}

    public static function fromArray(array $array): DoctorDTO
    {
        return new self(
            name: $array['name'],
            email: $array['email'],
            password: $array['password'] ?? null,
            department_id: $array['department_id'] ?? null,
            specialization: $array['specialization'] ?? null,
            qualification: $array['qualification'] ?? null,
            consultation_fee: $array['consultation_fee'] ?? null,
        );
    }

    public function toArray(string $json): array{
        return [
            'name' => $this->name,
            'password' => $this->password,
            'department_id' => $this->department_id,
            'specialization' => $this->specialization,
            'qualification' => $this->qualification,
            'email' => $this->email,
            'consultation_fee' => $this->consultation_fee
        ];
    }
}
