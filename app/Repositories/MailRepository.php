<?php

namespace App\Repositories;

use App\Models\Mail;
use App\Models\Scopes\MailScope;
use App\Repositories\BaseRepository;
use App\Traits\Uploader;
use Illuminate\Database\Eloquent\Model;

class MailRepository extends BaseRepository
{

    use Uploader;
    protected $fieldSearchable = [
        'objet',
        'ref',
        'body'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Mail::class;
    }

    public function find(int $id, array $columns = ['*'])
    {

        $query = $this->model->newQuery()->withoutGlobalScope(MailScope::class);

        return $query->find($id, $columns);
    }


    public function create($input): Model
    {
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
