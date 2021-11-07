<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\DepartmentService;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
	protected $departmentService;

	public function __construct(DepartmentService $departmentService)
	{
		$this->departmentService = $departmentService;
	}
}
