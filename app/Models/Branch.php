<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)->withPivot('is_active','is_display_qty','quantity','quantity_warn')->withTimestamps();
    }
}
