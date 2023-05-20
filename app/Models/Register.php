<?php

namespace App\Models;

use App\Models\Scopes\RegisterYearScope;
use App\Models\Scopes\ServiceScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Register extends Model
{
    use HasFactory;

    public $types = [
        'ar' => [
            1 => 'داخلي',
            2 => 'خارجي',
        ],
        'en' => [
            1 => 'Internal',
            2 => 'External',
        ],
    ];
    public $categories = [
        'ar' => [
            1 => 'وارد',
            2 => 'صادر',
        ],
        'en' => [
            1 => 'In-coming',
            2 => 'Out-coming',
        ],
    ];
    public $table = 'registers';

    public $fillable = [
        'label_ar',
        'label_en',
        'year',
        'service_id',
        'starting_nbr',
        'licence',
        'type',
        'category'
    ];

    protected $casts = [
        'id' => 'integer',
        'label_ar' => 'string',
        'label_en' => 'string',
        'licence' => 'string'
    ];

    public static array $rules = [
        'label_ar' => 'required',
        'label_en' => 'required',
        'year' => 'required',
        'service_id' => 'required',
        'starting_nbr' => 'required',
        'licence' => 'required'
    ];
    protected function type(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $this->types[\App::getLocale()][$value],
        );
    }
    protected function category(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $this->categories[\App::getLocale()][$value],
        );
    }


    public function service(): belongsTo
    {
        return $this->belongsTo(Service::class);
    }


    public function scopeIncome(Builder $builder,$type=1): void
    {
        $builder->where('category', 1);
    }

    public function scopeOutcome(Builder $builder, $type=1): void
    {
        $builder->where('category', 2);
    }

    public function mails()
    {
        return $this->belongsToMany(Mail::class)
            ->withPivot(
                [
                    'arrived_at',
                    'arrived_data',
                    'receiver_id',
                    'recorded_at',
                    'recorded_data',
                    'arrived_number',
                    'processed_at',
                    'processed_data',
                    'processed_orientations',
                    'sent_at',
                    'sent_to',
                    'sent_number',
                    'sender_id'
                ]
            )
            ->using(circulation::class)
            ->withTimestamps();
    }


    protected static function booted()
    {
        static::addGlobalScope(new ServiceScope());
        static::addGlobalScope(new RegisterYearScope());
    }
}
