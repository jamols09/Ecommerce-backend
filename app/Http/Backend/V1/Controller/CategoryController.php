<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Requests\Backend\CategoryCreateRequest;
use App\Http\Backend\V1\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    /**
     * Get all category dropdown
     * @return JSON
     */
    public function dropdown()
    {
        try {
            $result['body'] = $this->categoryService->dropdown();
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    /**
     * Geneerate category 
     * @param App\Http\Requests\Backend\CategoryCreateRequest $request
     * @return JSON
     */
    public function create(CategoryCreateRequest $request)
    {
        try {
            $result['body'] = $this->categoryService->create($request->validated());
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    /**
     * Get all category paginated
     * @return JSON
     */
    public function table()
    {
        try {
            $result['body'] = QueryBuilder::for(Category::class)
                ->allowedFilters([
                    'name',
                    'created_at'
                ])
                ->allowedSorts(
                    'name',
                    'created_at'
                )
                ->paginate(request()->query()['row'] ?? 10)
                ->onEachSide(1);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    /**
     * Get all category paginated
     * @param Illuminate\Http\Request $request
     * @return JSON
     */
    public function delete(Request $request)
    {
        try {
            $result['body'] = $this->categoryService->delete($request->only(['id']));
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
