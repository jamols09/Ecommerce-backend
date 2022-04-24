<?php

namespace App\Http\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterBranchItemName implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('branches', function (Builder $query) use ($value) {
            $query->where('items.name', 'LIKE', '%'.$value.'%');
        });
    }
}
