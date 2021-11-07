<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Models\Brand;

class BranchService
{
	public function create($data)
	{
		return Brand::create($data);
	}
}
