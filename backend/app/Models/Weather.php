<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    // Allow these fields for mass assignment
    protected $fillable = [
        'city',
        'temperature',
        'recorded_at',
    ];
}

