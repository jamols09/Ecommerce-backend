<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Checks if generated SKU is unique
     */
    public function scopeUniqueSKU(Builder $query, string $sku): Builder
    {
        return $query->where('sku', '=', $sku);
    }

    /**
     * Get department assigned to this item
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get brand assigned to this item
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get all items related to specified branch
     */
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class)
            ->withPivot('is_active', 'is_display_qty', 'quantity', 'quantity_warn')
            ->withTimestamps();
    }
}
