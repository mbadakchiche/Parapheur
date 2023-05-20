<?php

namespace App\Repositories;

use App\Models\Register;
use App\Repositories\BaseRepository;

class RegisterRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label_ar',
        'label_en',
        'year'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Register::class;
    }
}
