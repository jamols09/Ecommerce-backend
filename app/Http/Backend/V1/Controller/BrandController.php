<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\BrandService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BrandCreateRequest;
use Exception;

class BrandController extends Controller
{
	protected $brandService;

	public function __construct(BrandService $brandService)
	{
		$this->brandService = $brandService;
	}

	/**
	 * Get brands list
	 * 
	 * @return Json 
	 */
	public function dropdown()
	{
		try {
			$result['body'] = $this->brandService->dropdown();
		} catch (Exception $e) {
			$result = [
				'error' => $e->getMessage(),
			];
			return response()->json($result, 500);
		}
		return response()->json($result, 200);
	}

	/**
	 * Generate brand
	 * 
	 * @param BrandCreateRequest $request
	 * @return Json 
	 */
	public function create(BrandCreateRequest $request)
	{
		try {
			$result['body'] = $this->brandService->create($request->validated());
		} catch (Exception $e) {
			$result = [
				'error' => $e->getMessage(),
			];
			return response()->json($result, 500);
		}
		return response()->json($result, 200);
	}
}
