<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Requests\Backend\CategoryCreateRequest;
use App\Http\Backend\V1\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryEditRequest;
use App\Http\Resources\Backend\CategoryResource;
use App\Http\Resources\Backend\CategoryTableCollection;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
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
     * 
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
     * Generate category 
     * 
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
     * Get all paginated category
     * 
     * @return JSON
     */
    public function table(): CategoryTableCollection
    {
        try {
            $data = QueryBuilder::for(Category::class)
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
            return new CategoryTableCollection($data);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
    }

    /**
     * Remove category
     * 
     * @param Illuminate\Http\Request $request
     * @return JSON
     */
    public function destroy(Request $request)
    {
        try {
            $result['body'] = $this->categoryService->destroy($request->only(['id']));
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    /**
     * Get Category id details
     * 
     * @param App\Models\Category $id
     * @return JSON
     */
    public function show(Category $id)
    {
        try {
            return new CategoryResource($id);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
    }

    /**
     * Update Category details by id
     * 
     * @param App\Http\Requests\Backend\CategoryEditRequest $request
     * @param int $id
     * @return JSON
     */
    public function update(CategoryEditRequest $request, int $id)
    {
        try {
            $result['id'] = $id;
            $result['success'] = $this->categoryService->update($request->validated(), $id);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
