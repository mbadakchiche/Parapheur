<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
class Action extends Model
{
    use HasFactory;    public $table = 'actions';

    public $fillable = [
        'name_ar',
        'name_en'
    ];

    protected $casts = [
        'id' => 'integer',
        'name_ar' => 'string',
        'name_en' => 'string'
    ];

    public static array $rules = [
        'name_ar' => 'required',
        'name_en' => 'required'
    ];

    
}
