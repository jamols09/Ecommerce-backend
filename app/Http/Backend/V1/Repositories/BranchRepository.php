<?php

namespace App\Http\Backend\V1\Repositories;

use App\Models\Branch;
use App\Models\User;

class BranchRepository
{
    protected $branch;

    /**
     * BranchRepository constructor.
     *
     * @param Branch 
     */
    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    /**
     * Create branch from admin
     */
    public function create($data)
    {

        return $this->branch::create($data);
    }

    /**
     * Get all branches from dropdown
     * @return App\Models\Branch ['id','name']
     */
    public function getDropdown()
    {
        return $this->branch::orderBy('name')->get(['id', 'name']);
    }
}
