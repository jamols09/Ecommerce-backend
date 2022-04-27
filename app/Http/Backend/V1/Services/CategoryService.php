<?php

namespace App\Http\Backend\V1\Services;

use App\Http\Backend\V1\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class CategoryService
{
	protected $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * Create Category
	 * @param array $data
	 * @return string
	 */
	public function create(array $data)
	{
		return Category::create($data)->name;
	}

	/**
	 * Returns all Category in ascending order
	 * @return App\Models\Category
	 */
	public function dropdown()
	{
		return $this->categoryRepository->dropdown();
	}

	/**
	 * Soft deletes selected Categories
	 * @param array $data
	 * @return bool | string
	 */
	public function destroy(array $data)
	{
		foreach ($data['id'] as $value) {
			if(Category::hasChild($value)) {
				return abort(403, 'Invalid. Node has a child.');
			}	
		}
		return $this->categoryRepository->destroy($data);
	}

	/**
	 * Updates Category details
	 * @param array $data
	 * @param int $id
	 * @return bool
	 */
	public function update(array $data, int $id)
	{
		return DB::transaction(function () use ($data, $id) {
            return Category::find($id)->update($data);
        });
	}
}
