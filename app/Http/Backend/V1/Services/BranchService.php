<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\BranchRepository;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class BranchService
{
    protected $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    /**
     * Create branch
     * 
     * @param array $data
     * @return App\Models\Branch
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Branch::create($data)->id;
        });
    }

    /**
     * Get all active branch
     * 
     * @return App\Models\Branch
     */
    public function dropdown()
    {
        return Branch::active()->orderBy('name')->get();
    }

    /**
     * Remove selected branch with relation to pivot table
     * 
     * @param array $data
     * @return App\Models\Branch
     */
    public function delete(array $data)
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
        return DB::transaction(function () use ($data) {
            foreach ($data['id'] as $value) {
                $query = Branch::find($value)->update(['is_active' => $data['status'] == 'activate' ? 1 : 0]);
            }
            return $query;
        });
    }

    /**
     * Update branch details
     * 
     * @param array details
     * @param integer id
     * @return bool
     */
    public function update(array $data, int $id)
    {
        return DB::transaction(function () use ($data, $id) {
            return Branch::find($id)->update($data);
        });
    }
}
