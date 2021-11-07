<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\BrandService;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	protected $brandService;

	public function __construct(BrandService $brandService)
	{
		$this->brandService = $brandService;
	}
}
