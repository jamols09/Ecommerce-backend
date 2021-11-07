<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\DepartmentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\DepartmentCreateRequest;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DepartmentController extends Controller
{
	protected $departmentService;

	public function __construct(DepartmentService $departmentService)
	{
		$this->departmentService = $departmentService;
	}

	
	public function getDropdown()
	{
		try {
			$result['body'] = $this->departmentService->getDropdown();
		} 
		catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result,500);
        }
        return response()->json($result, 200);
	}

	public function create(DepartmentCreateRequest $request)
	{
		try {
            $result['body'] = $this->departmentService->create($request->validated());
        } 
		catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result,500);
        }
        return response()->json($result, 200);
	}

}
