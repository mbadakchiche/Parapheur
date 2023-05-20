<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\BaseRepository;
use App\Traits\Uploader;
use Illuminate\Database\Eloquent\Model;

class ServiceRepository extends BaseRepository
{

    use Uploader;
    protected $fieldSearchable = [
        'name_ar',
        'name_en',
        'thumbnail',
        'abr_latin',
        'abr_ar'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Service::class;
    }

    public function create($input): Model
    {
        $model = parent::create($input);

        if (array_key_exists('thumbnail', $input)) {
            (is_array($input['thumbnail'])) ?
                $this->uploadAsArray($model, 'Uploads/'.\Auth::id(),'thumbnail',$input,'thumbnail','thumbnail')
                : $model->syncMedia($this->uploadAsFile('Uploads/'.\Auth::id(),'thumbnail',$input,'thumbnail'), 'thumbnail');
        }
        return $model;
    }

    public function update(array $input, int $id)
    {
        $model =  parent::update($input, $id);

        if (array_key_exists('thumbnail', $input)) {
            (is_array($input['thumbnail'])) ?
                $this->uploadAsArray($model, 'Uploads/'.\Auth::id(),'thumbnail',$input,'thumbnail','thumbnail')
                : $model->syncMedia($this->uploadAsFile('Uploads/'.\Auth::id(),'thumbnail',$input,'thumbnail'), 'thumbnail');
        }

        return $model;
    }
}
