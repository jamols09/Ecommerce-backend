<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\ItemService;
use App\Http\Controllers\Controller;
use App\Http\Filters\FilterBranchItem;
use App\Http\Requests\Backend\ItemCreateRequest;
use App\Http\Requests\Backend\ItemGetRequest;
use App\Http\Requests\Backend\ItemUpdateStatusRequest;
use App\Http\Resources\Backend\ItemTableCollection;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;
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
            $data = QueryBuilder::for(Item::class)
                ->select([
                    'items.id',
                    'items.name',
                    'items.department_id',
                    'items.brand_id',
                    'items.is_discountable',
                    'items.created_at',
                    'items.sku'
                ])
                ->with(
                    'department:departments.id,name',
                    'brand:brands.id,name',
                    'branches:branches.id,is_active'
                )
                ->allowedFilters([
                    AllowedFilter::custom('branch', new FilterBranchItem()),
                    'name',
                    'is_discountable',
                    'created_at',
                    'sku'
                ])
                ->allowedSorts(
                    'name',
                    'is_discountable',
                    'created_at',
                    'sku'
                )
                ->paginate(request()->query()['row'] ?? 100)
                ->onEachSide(1);
                // $result['body'] = $data;
            return new ItemTableCollection($data);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        // return response()->json($result, 200);
    }


    /**
     * General item status: will apply to all branches for specific item.
     * Applies status change to column: is_discountable
     * 
     * @param Illuminate\Http\Request $request
     */
    public function status(ItemUpdateStatusRequest $request) 
    {
        try {
            $result['body'] = $this->itemService->status($request->validated());
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }
}
