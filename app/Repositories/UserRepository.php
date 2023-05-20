<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }


    public function create(array $input): Model
    {
        $password = $input['password'];

        $input['password'] =bcrypt($password);

        $user = parent::create($input);

        $roleAdmin = config('roles.models.role')::where('id', '=', $input['role_id'])->first();

        $user->attachRole($roleAdmin);

        return $user;
    }
}
