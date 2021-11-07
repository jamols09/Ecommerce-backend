<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Requests\Backend\CategoryCreateRequest;
use App\Http\Backend\V1\Services\CategoryService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function dropdown()
    {
        try {
            $result['body'] = $this->categoryService->dropdown();
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result,500);
        }
        return response()->json($result, 200);
    }

    public function create(CategoryCreateRequest $request)
    {
        try {
            $result['body'] = $this->categoryService->create($request->validated());
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result,500);
        }
        return response()->json($result, 200);
    }
    
    public function table(Request $request)
    {
        try {
            $result['body'] = $this->categoryService->table($request);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result,500);
        }
        return response()->json($result, 200);
    }

    public function delete(Request $request)
    {
        Log::debug($request);
        try {
            $result['body'] = $this->categoryService->delete($request->only(['id']));
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result,500);
        }
        return response()->json($result, 200);
    }
}
