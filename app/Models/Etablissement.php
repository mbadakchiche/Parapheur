<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Plank\Mediable\Mediable;

class Etablissement extends Model
{
    use HasFactory;
    use Mediable;
    public $table = 'etablissements';

    public $fillable = [
        'name_en',
        'name_ar'
    ];

    protected $casts = [
        'id' => 'integer',
        'name_en' => 'string',
        'name_ar' => 'string'
    ];

    public static array $rules = [
        'name_en' => 'required',
        'name_ar' => 'nullable'
    ];


}
