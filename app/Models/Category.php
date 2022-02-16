<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'category';

    protected $casts = [
        'created_at' => "datetime:Y-m-d",
    ];

    protected $fillable = [
        'name',
        'parent_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
    ];

    public function scopeHasChild($query, $value)
    {
        return $query->with('children')->where('parent_id', $value)->exists();
    }

    /**
     * @return BelongsTo
     */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id','id')->orderBy('name');
    }
}
