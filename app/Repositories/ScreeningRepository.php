<?php

namespace App\Repositories;

use App\Models\Screening;

class ScreeningRepository
{
    public function getAll() {
        return Screening::all();
    }

    public function store($values): Screening {
        return Screening::create($values);
    }

    public function update(Screening $screening, array $values): Screening {
        return tap($screening)->update($values);
    }

    public function delete(Screening $screening): void {
        $screening->delete();
    }
}
