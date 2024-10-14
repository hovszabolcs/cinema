<?php

namespace App\Services;

use App\Models\Screening;
use App\Repositories\ScreeningRepository;
use Illuminate\Support\Collection;

class ScreeningService
{
    public function __construct(
        protected ScreeningRepository $repository
    )
    {}

    public function getAll(): Collection {
        return $this->repository->getAll();
    }

    public function store(array $values): Screening
    {
        return $this->repository->store($values);
    }

    public function update(array $values, Screening $screening): Screening
    {
        return $this->repository->update($screening, $values);
    }

    public function delete(Screening $screening): void {
        $this->repository->delete($screening);
    }
}
