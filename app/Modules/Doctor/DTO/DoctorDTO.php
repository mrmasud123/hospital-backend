<?php
namespace App\Modules\Doctor\DTO;

class DoctorDTO{
    public function __construct(
        public readonly string $name,
//        public readonly int $id,
        public readonly ?int $department_id = null,
        public readonly ?string $specialization =null,
        public readonly ?string $qualification =null,
        public readonly string $email,
//        public readonly ?string $phone =null,
        public readonly ?float $consultation_fee =null,
    ){}

    public static function fromArray(array $array): DoctorDTO{
        return new self(
            name: $array['name'],
//            id: $array['user_id'],
            department_id: $array['department_id'],
            specialization: $array['specialization'],
            qualification: $array['qualification'],
            email: $array['email'],
//            phone: $array['phone'],
            consultation_fee: $array['consultation_fee'],
        );
    }

    public function toArray(string $json): array{
        return [
            'name' => $this->name,
//            'user_id' => $this->id,
            'department_id' => $this->department_id,
            'specialization' => $this->specialization,
            'qualification' => $this->qualification,
            'email' => $this->email,
//            'phone' => $this->phone,
            'consultation_fee' => $this->consultation_fee
        ];
    }
}
