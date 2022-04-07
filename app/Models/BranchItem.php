<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchItem extends Model
{
    use HasFactory;


    protected $table = 'branch_item';

    protected $fillable = [
        'is_active',
        'is_display_qty',
        'quantity',
        'quantity_warn',
        'price',
    ];


}
