<?php

namespace App\Http\Backend\V1\Services;

use App\Http\Backend\V1\Repositories\CategoryRepository;

class CategoryService
{
	protected $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	public function create($data)
	{
		return $this->categoryRepository->create($data);
	}

  public function getDropdown()
  {
    return $this->categoryRepository->getDropdown();
  }

	public function getAll($data)
	{
		return $this->categoryRepository->getAll($data);
	}
}
