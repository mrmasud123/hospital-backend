<?php
namespace App\Modules\Doctor\Interfaces;

use App\Modules\Doctor\DTO\DoctorDTO;

interface DoctorRepositoryInterface{

//    public function create(DoctorDTO $dto);
    public function find(int $id);
    public function update(int $id, DoctorDTO $dto);

}
