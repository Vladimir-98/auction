<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    const CHECKBOX = 'checkBox';
    const RANGE_INPUT = 'rangeInput';
    const MIN_MAX = ['min' => null, 'max' => null];
    const CATEGORIES = 'categories';
    const DISTRICTS = 'districts';
    const PAYMENT_TYPE = 'paymentType';
    const BUDGET = 'budget';
    const LEAD_PRICE = 'leadPrice';

    protected $fillable = [
        'name',
        'title',
        'type',
        'dropDown',
        'active',
        'items'
    ];

    protected $casts = [
        'dropDown' => 'boolean',
        'active' => 'boolean'
    ];
}
