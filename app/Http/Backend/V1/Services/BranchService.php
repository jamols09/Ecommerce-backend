<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\BranchRepository;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

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

    /**
     * Get all branch
     */

    public function dropdown()
    {
        return $this->branchRepository->dropdown();
    }

    /**
     * Remove selected branch with relation to pivot table
     * 
     * @param array $data
     * @return App\Models\Branch
     */
    public function delete($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data['id'] as $value) {
                Branch::find($value)->items()->detach();
                $query = Branch::find($value)->delete();
            }
            return $query;
        });
    }

    /**
     * Set status of selected id
     * 
     * @param array $data
     * @return App\Models\Branch
     */
    public function status($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data['id'] as $value) {
                $query = Branch::find($value)->update(['is_active' => $data['status'] == 'activate' ? 1 : 0]);
            }
            return $query;
        });
    }
}
