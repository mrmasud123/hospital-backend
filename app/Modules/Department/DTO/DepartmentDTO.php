<?php

namespace App\Modules\Department\DTO;

class DepartmentDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly ?string $description = null,
        public readonly ?int $headDoctorId = null,
        public readonly ?string $phone = null,
        public readonly ?string $email = null,
        public readonly ?string $location = null,
        public readonly bool $isActive = true,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            code: $data['code'],
            description: $data['description'] ?? null,
            headDoctorId: $data['head_doctor_id'] ?? null,
            phone: $data['phone'] ?? null,
            email: $data['email'] ?? null,
            location: $data['location'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'head_doctor_id' => $this->headDoctorId,
            'phone' => $this->phone,
            'email' => $this->email,
            'location' => $this->location,
            'is_active' => $this->isActive,
        ];
    }
}
