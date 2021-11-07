<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Models\Brand;

class BrandService
{
	public function dropdown()
	{
		return Brand::orderBy('name')->get(['id','name']);
	}

	public function create($data)
	{
		return Brand::create($data);
	}
}
