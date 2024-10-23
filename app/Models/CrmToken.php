<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrmToken extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'name'];
}
