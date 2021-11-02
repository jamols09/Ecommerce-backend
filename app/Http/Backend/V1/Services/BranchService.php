<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\BranchRepository;

class BranchService
{
	protected $branchRepository;

	public function __construct(BranchRepository $branchRepository)
	{
		$this->branchRepository = $branchRepository;
	}

	public function create($data)
	{
		return $this->branchRepository->create($data);
	}

	public function getDropdown()
	{
		return $this->branchRepository->getDropdown();
	}
}
