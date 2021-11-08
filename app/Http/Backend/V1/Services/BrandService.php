<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Models\Brand;

class BrandService
{
	/**
	 * Retrieve all brand
	 * 
	 * @return Brand id,name
	 */
	public function dropdown()
	{
		return Brand::orderBy('name')->get(['id', 'name']);
	}

	/**
	 * Generate brand
	 * 
	 * @return Brand
	 */
	public function create($data)
	{
		return Brand::create($data);
	}
}
