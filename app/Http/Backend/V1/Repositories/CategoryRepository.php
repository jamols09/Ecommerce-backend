<?php

namespace App\Http\Backend\V1\Repositories;

use App\Models\Category;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    protected $category;

    /**
     * CategoryRepository constructor.
     * @param App\Models\Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Create category from admin
     * @param array $data
     * @return App\Models\Category;
     */
    public function create(array $data)
    {
        DB::transaction(function () use ($data) {
            return $this->category::create($data);
        });
    }

    /**
     * Get all category from dropdown
     * @return App\Models\Category id,name
     */
    public function dropdown()
    {
        return $this->category::orderBy('name')->get(['id', 'name']);
    }

    /**
     * Delete all selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function delete(array $data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data['id'] as $value) {
                $query = $this->category::find($value)->delete();
            }
            return $query;
        });
    }
}
