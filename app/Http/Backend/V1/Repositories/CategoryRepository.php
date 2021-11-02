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
	public function getAll($data)
	{
		$query = $this->category::query()->with('parent:id,name');

		switch ($data['type']) {
			case 'Created At':
				$query = $query->where('created_at', 'LIKE', '%' . $data['q'] . '%');
				break;
			case 'Name':
				$query = $query->where('name', 'LIKE', '%' . $data['q'] . '%');
				break;
			default:
				# code...
				break;
		}

		if($data['col']) {
			$query = $query->orderBy(str_replace(' ', '_', $data['col']), $data['order']);
		}

		if ($data['row']) {
			$query = $query->paginate($data['row']);
		}

		return $query->onEachSide(1);
	}
}
