<?php

namespace App\Http\Backend\V1\Repositories;

use App\Models\Category;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class CategoryRepository
{
    protected $category;

    /**
     * CategoryRepository constructor.
     * @param Category 
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
    public function create($data)
    {
        return $this->category::create($data);
    }

    /**
     * Get all category from dropdown
     * @return App\Models\Category id,name
     */
    public function getDropdown()
    {
        return $this->category::orderBy('name')->get(['id', 'name']);
    }

    /**
     * Get all category paginated
     * @param array $data
     * @return App\Models\Category
     */
    public function table($data)
    {

        $query = $this->category::query()->with('parent:id,name');

        switch (strtolower($data['type'])) {
            case 'created at':
                $query = $query->where('created_at', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'name':
                $query = $query->where('name', 'LIKE', '%' . $data['q'] . '%');
                break;
            default:
                # code...
                break;
        }

        if ($data['col']) {
            $query = $query->orderBy(str_replace(' ', '_', $data['col'] ?? 'name'), $data['order'] ?? 'asc');
        }

        if ($data['row']) {
            $query = $query->paginate($data['row'] ?? 1)->onEachSide(1);
        }

        return $query;
    }

    /**
     * Delete all selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function delete($data)
    {
        
        foreach ($data['id'] as $value) {
            $query = $this->category::find($value)->delete();
        }

        return $query;
    }
}
