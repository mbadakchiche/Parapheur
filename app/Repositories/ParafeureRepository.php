<?php

namespace App\Repositories;

use App\Models\Parafeure;
use App\Repositories\BaseRepository;
use App\Traits\Uploader;
use Illuminate\Database\Eloquent\Model;

class ParafeureRepository extends BaseRepository
{
    use Uploader;
    protected $fieldSearchable = [
        'service_id',
        'title'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Parafeure::class;
    }


    public function create($input): Model
    {
        $input['initiated_by']= auth()->user()->service_id;

        $model = parent::create($input);

        if (array_key_exists('attachments', $input)) {
            (is_array($input['attachments'])) ?
                $this->uploadAsArray($model, 'Uploads/'.\Auth::id(),'attachments',$input,'attachments','attachments')
                : $model->syncMedia($this->uploadAsFile('Uploads/'.\Auth::id(),'attachments',$input,'attachments'), 'attachments');
        }
        return $model;
    }

    public function update(array $input, int $id):Model
    {
        $model =  parent::update($input, $id);

        if (array_key_exists('attachments', $input)) {
            (is_array($input['attachments'])) ?
                $this->uploadAsArray($model, 'Uploads/'.\Auth::id(),'attachments',$input,'attachments','attachments')
                : $model->syncMedia($this->uploadAsFile('Uploads/'.\Auth::id(),'attachments',$input,'attachments'), 'attachments');
        }

        return $model;
    }
}
