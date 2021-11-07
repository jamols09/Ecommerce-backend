<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Models\Brand;

class BrandService
{
	public function create($data)
	{
		return Brand::create($data);
	}
}
