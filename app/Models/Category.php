<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * @return BelongsTo
     */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class,'parent_id');
    }
}
