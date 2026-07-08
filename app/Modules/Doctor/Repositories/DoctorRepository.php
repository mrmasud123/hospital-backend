<?php
namespace App\Modules\Doctor\Repositories;

use App\Models\User;
use App\Modules\Doctor\DTO\DoctorDTO;
use App\Modules\Doctor\Interfaces\DoctorRepositoryInterface;
use App\Modules\Doctor\Models\DoctorProfile;

class DoctorRepository implements DoctorRepositoryInterface{
    public function find(int $id){
        return User::with('doctorProfile.department')->findOrFail($id);
    }
    public function update(int $id, DoctorDTO $dto){
        $doctor= $this->find($id);
        $doctor->update([
            'name' => $dto->name,
            'email' => $dto->email,
        ]);

        DoctorProfile::updateOrCreate(
            ['user_id' =>$doctor->id],
            [
                'user_id' => $doctor->id,
                'department_id' => $dto->department_id,
                'specialization' => $dto->specialization,
                'qualification' => $dto->qualification,
                'consultation_fee' => $dto->consultation_fee,
            ]
        );
        return $doctor;
    }
}
