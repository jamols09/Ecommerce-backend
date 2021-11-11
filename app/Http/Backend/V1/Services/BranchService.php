<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\BranchRepository;
use App\Models\Branch;

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

	public function dropdown()
	{
		return $this->branchRepository->dropdown();
	}

    /**
     * Delete all selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function delete($data)
    {
        foreach ($data['id'] as $value) {
            $query = Branch::find($value)->delete();
        }
        return $query;
    }

    /**
     * Set status of selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function status($data)
    {
        foreach ($data['id'] as $value) {
            $query = Branch::find($value)->update(['is_active' => $data['status'] == 'activate' ? 1 : 0]);
        }
        return $query;
    }
}
