<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\DepartmentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DepartmentCreateRequest;
use Exception;

class DepartmentController extends Controller
{
	protected $departmentService;

	public function __construct(DepartmentService $departmentService)
	{
		$this->departmentService = $departmentService;
	}

	

	public function dropdown()
	{
		try {
			$result['body'] = $this->departmentService->dropdown();
		} catch (Exception $e) {
			$result = [
				'error' => $e->getMessage(),
			];
			return response()->json($result, 500);
		}
		return response()->json($result, 200);
	}

	/**
	 * Create department
	 * 
	 * @param App\Http\Requests\Backend\DepartmentCreateRequest $request
	 */

	public function create(DepartmentCreateRequest $request)
	{
		try {
			$result['body'] = $this->departmentService->create($request->validated());
		} catch (Exception $e) {
			$result = [
				'error' => $e->getMessage(),
			];
			return response()->json($result, 500);
		}
		return response()->json($result, 200);
	}
}
