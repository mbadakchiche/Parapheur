<?php

namespace App\Repositories;

use App\Models\Dossier;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class DossierRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'label_ar',
        'label_en'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Dossier::class;
    }

    public function create(array $input): Model
    {
        $input['service_id'] = auth()->user()->service_id;
        return parent::create($input); // TODO: Change the autogenerated stub
    }
}
