<?php

namespace App\Http\Backend\V1\Repositories;

use App\Models\Branch;

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

}
