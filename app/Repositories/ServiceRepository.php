<?php

namespace App\Repositories;

use App\Models\Service;
use App\Traits\Uploader;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
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
        //create a manager
        $data = [
            'name' => $input['name_en']."_manager",
            'email' => Str::slug($input['abr_ar'], '-')."_manager@mesrs.dz",
            'email_verified_at' => Carbon::now(),
            'password' => 'password',
            'service_id'=>$model->id,
            'role_id'=> config('roles.models.role')::where('name', 'manager')->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        (new UserRepository())->create($data);
        $data = [
            'name' => $input['name_en']."_secretariat",
            'email' => Str::slug($input['abr_ar'], '-')."_secretariat@mesrs.dz",
            'email_verified_at' => Carbon::now(),
            'password' => 'password',
            'service_id'=>$model->id,
            'role_id'=> config('roles.models.role')::where('name', 'secretariat')->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        (new UserRepository())->create($data);
        //create a secretariat

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
