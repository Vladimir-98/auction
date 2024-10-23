<?php

namespace App\Models\Card;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Card extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'desc',
        'phone',
        'budget_min',
        'budget_max',
        'lead_price',
        'status_id',
        'crm_id',
        'crm_url',
    ];

    protected $appends = [
        'stringTypes',
        'stringDistricts',
        'stringPaymentType',
        'budgetRange'
    ];

    public function getStringTypesAttribute(): string
    {
        return implode(', ', $this->types()->pluck('name')->toArray());
    }

    public function getStringDistrictsAttribute(): string
    {
        return implode(', ', $this->districts()->pluck('name')->toArray());
    }

    public function getStringPaymentTypeAttribute(): string
    {
        return implode(', ', $this->payment_types()->pluck('name')->toArray());
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CardStatus::class);
    }

    public function callRecords(): HasMany
    {
        return $this->hasMany(CallRecord::class);
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(
            City::class,
            'card_city',
            'card_id',
            'city_id'
        );
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(
            Type::class,
            'card_type',
            'card_id',
            'type_id'
        );
    }

    public function districts(): BelongsToMany
    {
        return $this->belongsToMany(
            District::class,
            'card_district',
            'card_id',
            'district_id'
        );
    }

    public function payment_types(): BelongsToMany
    {
        return $this->belongsToMany(
            PaymentType::class,
            'card_payment_type',
            'card_id',
            'payment_type_id'
        );
    }

    public function getBudgetRangeAttribute(): ?string
    {
        $min = (int) $this->budget_min;
        $max = (int) $this->budget_max;

        if ($min && $max) {
            return number_format($min, 0, '', ' ') . ' - ' . number_format($max, 0, '', ' ');
        } elseif ($min) {
            return number_format($min, 0, '', ' ');
        } elseif ($max) {
            return number_format($max, 0, '', ' ');
        }

        return null;
    }

}
