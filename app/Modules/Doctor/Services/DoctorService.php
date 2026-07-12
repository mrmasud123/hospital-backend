<?php
namespace App\Modules\Doctor\Services;

use App\Modules\Doctor\DTO\DoctorDTO;
use App\Modules\Doctor\Interfaces\DoctorRepositoryInterface;

class DoctorService{
    public function __construct(protected DoctorRepositoryInterface $repository){}

    public function find(int $id){
        return $this->repository->find($id);
    }

    public function store(array $data){
        $dto= DoctorDTO::fromArray($data);
        return $this->repository->store($dto);
    }
    public function update(int $id, array $data){
        $dto= DoctorDTO::fromArray($data);

        return $this->repository->update($id, $dto);

    }
}
