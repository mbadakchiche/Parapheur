<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Plank\Mediable\Mediable;

class Parafeure extends Model
{
    use HasFactory;
    use Mediable;
    public $table = 'parafeures';

    public $fillable = [
        'initiated_by',
        'service_id',
        'title',
        'abstract',
        'signed',
        'signet_at'
    ];

    protected $casts = [
        'id' => 'integer',
        'service_id' => 'integer',
        'title' => 'string',
        'abstract' => 'string'
    ];

    public static array $rules = [
        'service_id' => 'required',
        'title' => 'nullable'
    ];

    public function initiated_by():HasOne
    {
        return $this->hasOne(Service::class,'id', 'initiated_by');
    }

    public function signed_by():HasOne
    {
        return $this->hasOne(Service::class,'service_id');
    }


}
