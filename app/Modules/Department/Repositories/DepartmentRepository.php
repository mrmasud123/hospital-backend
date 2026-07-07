<?php

namespace App\Modules\Department\Repositories;

use App\Modules\Department\Interfaces\DepartmentRepositoryInterface;
use App\Modules\Department\Models\Department;
use App\Modules\Department\DTO\DepartmentDTO;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function create(DepartmentDTO $dto)
    {
        return Department::create($dto->toArray());
    }

    public function find(int $id)
    {
        return Department::findOrFail($id);
    }

    public function update(int $id, DepartmentDTO $dto)
    {
        $department = $this->find($id);
        $department->update($dto->toArray());

        return $department;
    }
}
