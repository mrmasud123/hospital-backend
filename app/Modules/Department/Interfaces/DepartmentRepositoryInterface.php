<?php

namespace App\Modules\Department\Interfaces;

use App\Modules\Department\DTO\DepartmentDTO;

interface DepartmentRepositoryInterface
{
    public function create(DepartmentDTO $dto);
    public function find(int $id);
    public function update(int $id, DepartmentDTO $dto);
}
