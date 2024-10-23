<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_id',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'allows_write_to_pm',
        'status_id'
    ];

    protected $appends = ['balance'];

    public function getBalanceAttribute()
    {
        $totalReplenished = $this->replenishments()->sum('amount');
        $totalDeducted = $this->deductions()->sum('amount');
        return $totalReplenished - $totalDeducted;
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function client_type(): BelongsTo
    {
        return $this->belongsTo(ClientType::class);
    }

    public function replenishments(): HasMany
    {
        return $this->hasMany(Replenishment::class);
    }

    public function deductions(): HasMany
    {
        return $this->hasMany(Deduction::class);
    }
}
