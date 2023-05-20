<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $models = getAllModels();
        $PermissionItems = [];
        foreach ($models as $model){
            $PermissionItems = [
                [
                    'name' => 'Can View ' . Str::plural($model),
                    'slug' => 'view.' . Str::lower(Str::plural($model)),
                    'description' => 'Can view ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],
                [
                    'name' => 'Can Create ' . Str::plural($model),
                    'slug' => 'create.' . Str::lower(Str::plural($model)),
                    'description' => 'Can create new ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],
                [
                    'name'        => 'Can Edit '. Str::plural($model),
                    'slug'        => 'edit.'.Str::lower(Str::plural($model)),
                    'description' => 'Can edit ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],
                [
                    'name' => 'Can Delete ' . Str::plural($model),
                    'slug' => 'delete.' . Str::lower(Str::plural($model)),
                    'description' => 'Can delete ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],

                [
                    'name' => 'Can Record ' . Str::plural($model),
                    'slug' => 'record.' . Str::lower(Str::plural($model)),
                    'description' => 'Can record ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],

                [
                    'name' => 'Can Send ' . Str::plural($model),
                    'slug' => 'send.' . Str::lower(Str::plural($model)),
                    'description' => 'Can send ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],

                [
                    'name' => 'Can Process ' . Str::plural($model),
                    'slug' => 'process.' . Str::lower(Str::plural($model)),
                    'description' => 'Can process ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],
                [
                    'name' => 'Can Dispatch ' . Str::plural($model),
                    'slug' => 'dispatch.' . Str::lower(Str::plural($model)),
                    'description' => 'Can dispatch ' . Str::lower(Str::plural($model)),
                    'model' => 'Permission',
                ],
            ];
            /*
       * Add Permission Items
       *
       */
            foreach ($PermissionItems as $Permissionitem) {
                $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
                if ($newPermissionitem === null) {
                    $newPermissionitem = config('roles.models.permission')::create([
                        'name' => $Permissionitem['name'],
                        'slug' => $Permissionitem['slug'],
                        'description' => $Permissionitem['description'],
                        'model' => $Permissionitem['model'],
                    ]);
                }
            }
        }


    }
}
