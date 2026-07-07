<?php

namespace App\Modules\Department\Services;

use App\Modules\Department\Interfaces\DepartmentRepositoryInterface;
use App\Modules\Department\DTO\DepartmentDTO;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepositoryInterface $repository
    ) {}

    public function create(array $data)
    {
        $dto = DepartmentDTO::fromRequest($data);

        return $this->repository->create($dto);
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(int $id, array $data)
    {
        $dto = DepartmentDTO::fromRequest($data);

        return $this->repository->update($id, $dto);
    }
}
