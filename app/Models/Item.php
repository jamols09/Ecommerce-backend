<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'brand_id',
        'is_discountable',
        'sku',
        'name',
        'description',
        'color',
        'size',
        'material',
        'weight_unit',
        'weight_amount',
        'length',
        'width',
        'height',
    ];

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class)->withPivot('is_active', 'is_display_qty', 'quantity', 'quantity_warn');
    }
}
