<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\DepartmentService;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	protected $brandService;

	public function __construct(DepartmentService $brandService)
	{
		$this->brandService = $brandService;
	}
}
