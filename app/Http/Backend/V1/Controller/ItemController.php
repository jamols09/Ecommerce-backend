<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\ItemService;
use App\Http\Controllers\Controller;
use App\Http\Filters\FilterBranchItem;
use App\Http\Requests\Backend\ItemCreateRequest;
use App\Http\Requests\Backend\ItemGetRequest;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * Generate item per selected branch
     * 
     * @param App\Http\Requests\Backend\ItemCreateRequest $request
     * @return JSON
     */
    public function create(ItemCreateRequest $request)
    {
        try {
            $result['body'] = $this->itemService->create($request->validated());
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }


    /**
     * Get item per selected branch
     * 
     * @param App\Http\Requests\Backend\ItemGetRequest $request
     * @return JSON 
     */
    public function dropdown(ItemGetRequest $request)
    {
        try {
            $result['body'] = $this->itemService->dropdown($request->validated());
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    /**
     * Get paginated items or per selected branch
     * 
     * @param Illuminate\Http\Request
     * @return JSON
     */
    public function table(Request $result)
    {
        try {
            $result['body'] = QueryBuilder::for(Item::class)
                ->with('department','brand')
                ->allowedFilters([
                    AllowedFilter::custom('branch', new FilterBranchItem()),
                    'name',
                    'sku',
                    'created_at'
                ])
                ->allowedSorts(
                    'name',
                    'sku',
                    'created_at',
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
}
