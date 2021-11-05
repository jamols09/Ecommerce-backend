<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'name',
        'code',
        'country',
        'state',
        'city',
        'barangay',        
        'address_line_1',
        'address_line_2',
        'postal',
        'longitude',
        'latitude',
        'telephone',
        'mobile',
    ];
}
