<?php

namespace App\Http\Backend\V1\Services;

use App\Http\Backend\V1\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
	protected $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	public function create($data)
	{
		return Category::create($data)->name;
	}

	public function dropdown()
	{
		return $this->categoryRepository->dropdown();
	}

	public function destroy($data)
	{
		return $this->categoryRepository->destroy($data);
	}

	public function update($data, $id)
	{
		return DB::transaction(function () use ($data, $id) {
            return Category::find($id)->update($data);
        });
	}
}
