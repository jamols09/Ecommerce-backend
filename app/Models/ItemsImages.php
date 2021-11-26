<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemsImages extends Model
{
    use HasFactory;

    protected $table = 'items_images';

    public function items(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
