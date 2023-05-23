<?php

namespace App\Models;

use App\Models\Scopes\DossierScope;
use App\Models\Scopes\ServiceScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dossier extends Model
{
    use HasFactory;


    public $table = 'dossiers';

    public $statuses = [
        'ar' =>
            [
                '1' => 'مفتوح',
                '2' => 'معالجة',
                '3' => 'في انتظار رد',
                '4' => 'مغلق'
            ],
        'en' => [
            '1' => 'Opened',
            '2' => 'Processing',
            '3' => 'waiting for response',
            '4' => 'closed'
        ],
    ];

    public $bgColors=[
        'ar' =>
            [
                'مفتوح'=> 'bg-success',
                'معالجة' => 'bg-info',
                'في انتظار رد' => 'bg-danger',
                'مغلق' => 'bg-dark'
            ],
        'en' => [
            'Opened'=> 'bg-success',
            'Processing'=> 'bg-info',
            'waiting for response'=> 'bg-danger',
            'closed'=> 'bg-dark'
        ],
            '1' => 'bg-success',
            '2' => 'bg-info',
            '3' => 'bg-danger',
            '4' => 'bg-dark'
        ];
    public $fillable = [
        'label_ar',
        'label_en',
        'user_id',
        'status',
        'description',
        'service_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'label_ar' => 'string',
        'label_en' => 'string',
        'status' => 'integer',
        'description' => 'string'
    ];

    public static array $rules = [
        'label_ar' => 'required',
        'label_en' => 'required',
        'user_id' => 'required',
        'status' => 'required',
        'description' => 'required'
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->statuses[\App::getLocale()][$value],
        );
    }


    public function incharge_by():BelongsTo
    {
       return $this->belongsTo(User::class,'user_id');
    }

    public function service():BelongsTo
    {
       return $this->belongsTo(Service::class,'service_id');
    }

    public function mails():HasMany
    {
        return $this->hasMany(Mail::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new DossierScope());
    }


}
