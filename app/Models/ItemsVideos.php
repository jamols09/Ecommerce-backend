<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemsVideos extends Model
{
    use HasFactory;

    protected $table = 'items_videos';

    public function items(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
