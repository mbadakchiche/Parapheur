<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Plank\Mediable\Mediable;

class Service extends Model
{
    use HasFactory;
    use Mediable;


    public $table = 'services';

    public $fillable = [
        'name_ar',
        'name_en',
        'thumbnail',
        'abr_latin',
        'abr_ar'
    ];

    protected $casts = [
        'id' => 'integer',
        'name_ar' => 'string',
        'name_en' => 'string',
        'thumbnail' => 'string',
        'abr_latin' => 'string',
        'abr_ar' => 'string'
    ];

    public static array $rules = [
        'name_ar' => 'required',
        'name_en' => 'required',
        'thumbnail' => 'required',
        'abr_latin' => 'required',
        'abr_ar' => 'required'
    ];
    public static array $UpdateRules = [
        'name_ar' => 'required',
        'name_en' => 'required',
        'abr_latin' => 'required',
        'abr_ar' => 'required'
    ];


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function registers(): HasMany
    {
        return $this->hasMany(Register::class);
    }


    public function initiated_to():HasMany
    {
        return $this->hasMany(Parafeure::class,'initiated_by');
    }

    public function signed():HasMany
    {
        return $this->hasMany(Parafeure::class);
    }

}
