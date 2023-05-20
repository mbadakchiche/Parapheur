<?php

namespace App\Models;

use App\Models\Scopes\MailScope;
use App\Models\Scopes\ServiceScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Plank\Mediable\Mediable;

class Mail extends Model
{
    use HasFactory;
    use Mediable;

    public $table = 'mails';
    //TODO: Add Expediter to mail as VarChar 4049
    public $fillable = [
        'objet',
        'ref',
        'body',
        'service_id',
        'dossier_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'objet' => 'string',
        'ref' => 'string',
        'body' => 'string',
        'Expediter' => 'string',
    ];

    public static array $rules = [
        'objet' => 'required',
        'ref' => 'required',
    ];

    protected $field = [
        'arrived_at',
        'arrived_data',
        'receiver_id',
        'recorded_at',
        'recorded_data',
        'record_number',
        'processed_at',
        'processed_data',
        'processed_orientations',
        'sent_at',
        'sent_to',
        'sent_number',
        'sender_id',
        'arrived_from',
        'reference_number',
        'orientation_data',
        'orientation_text',
        'response_needed',
        'response_deadline',
        'dispatched_at'
    ];


    public function duplicate(int $service_id):Model
    {
        $copy = $this->replicate();
        $copy->service_id = $service_id;
        $copy->save();
        return $copy;
    }

    public function registers():BelongsToMany
    {
        return $this->belongsToMany(Register::class)
            ->withPivot($this->field)
            ->using(circulation::class)
            ->withTimestamps();
    }

    public function actualregister($value):BelongsToMany
    {
        return $this->belongsToMany(Register::class)
            ->withPivot($this->field)
            ->where('receiver_id',$value)
            ->withTimestamps();
    }

    public function processMailInRegisters($value):BelongsToMany
    {
        return $this->belongsToMany(Register::class)
            ->withPivot($this->field)
            ->where('receiver_id',$value)
            ->whereNotNull('processed_at')
            ->withTimestamps();
    }


    public function scopeIncome(Builder $builder, $value): void
    {
        $builder->whereHas('registers', function ($query) use ($value){
            $query->where('receiver_id', $value)
                  ->whereNotNull('recorded_at');
        });;
    }

    public function scopeOutcome(Builder $builder, $value): void
    {
        $builder->whereHas('registers', function ($query) use ($value) {
            $query->where('sender_id', $value)
                ->whereNotNull('sent_at');
        });
    }

    public function scopeOutcomeByType(Builder $builder, $value, $type): void
    {
        $builder->whereHas('registers', function ($query) use ($value, $type) {
            $query->where('sender_id', $value)
                ->whereNotNull('sent_at')
                ->where('type', $type);
        }
        );
    }
    public function scopeIncomeByType(Builder $builder, $value, $type): void
    {
        $builder->whereHas('registers', function ($query) use ($value, $type) {
            $query->where('receiver_id', $value)
                ->whereNotNull('sent_at')
                ->where('type', $type);
        }
        );
    }

    public function scopeNeedprocess(Builder $builder, $value): void
    {
        $builder->whereHas('registers', function ($query) use ($value) {
            $query->where('receiver_id', $value)
                ->whereNull('processed_at')
                ->whereNotNull('recorded_at');
        });;
    }

    public function scopeNeeddispatch(Builder $builder, $value): void
    {
        $builder->whereHas('registers', function ($query) use ($value){
            $query->where('receiver_id', $value)
                ->whereNotNull('processed_at')
                ->whereNotNull('processed_data')
                  ->whereNull('dispatched_at');
        });;
    }

    public function scopeArrived(Builder $builder, $value): void
    {
        $builder->whereHas('registers', function ($query) use ($value){
            $query->where('receiver_id', $value)
                  ->whereNull('recorded_at');
        });;
    }

    protected static function booted()
    {
        static::addGlobalScope(new MailScope());
        static::addGlobalScope(new ServiceScope());

    }
}

