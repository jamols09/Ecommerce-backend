<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\BranchService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BranchCreateRequest;
use App\Http\Requests\Backend\BranchEditRequest;
use App\Http\Resources\Backend\BranchDropdownCollection;
use App\Http\Resources\Backend\BranchResource;
use App\Http\Resources\Backend\BranchTableCollection;
use App\Models\Branch;
use Illuminate\Http\Request;
use Exception;
use Spatie\QueryBuilder\QueryBuilder;

class BranchController extends Controller
{
    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    /**
     * Get all branch for dropdown
     * 
     * @return JSON
     */
    public function dropdown()
    {
        try {
            $result['result'] = new BranchDropdownCollection($this->branchService->dropdown());
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];

            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }

    /**
     * Generate branch
     * @param App\Http\Requests\Backend\BranchCreateRequest $request
     * @return JSON
     */
    public function create(BranchCreateRequest $request)
    {
        try {
            $result['id'] = $this->branchService->create($request->validated());
            $result['success'] = true;
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];

            return response()->json($result, 500);
        }

        return response()->json($result, 200);
    }

    /**
     * Get paginated branch for table
     * 
     * @return Spatie\QueryBuilder\QueryBuilder 
     */
    public function table()
    {
        try {
            $data = QueryBuilder::for(Branch::class)
                ->select([
                    'branches.id',
                    'branches.is_active',
                    'branches.name',
                    'branches.code',
                    'branches.city',
                    'branches.barangay',
                    'branches.address_line_1',
                    'branches.telephone',
                    'branches.mobile'
                ])
                ->allowedFilters([
                    'name',
                    'code',
                    'city',
                    'barangay',
                    'address_line_1',
                    'telephone',
                    'mobile',
                ])
                ->allowedSorts(
                    'name',
                    'code',
                    'city',
                    'barangay',
                    'address_line_1',
                    'telephone',
                    'mobile',
                    'is_active'
                )
                ->paginate(request()->query()['row'] ?? 10)
                ->onEachSide(1);
            return new BranchTableCollection($data);
        } catch (\Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];

            return response()->json($result, 500);
        }
    }

    /**
     * Remove selected branch with relation to pivot table
     * 
     * @param Illuminate\Http\Request $request
     * @return JSON
     */
    public function destroy(Request $request)
    {
        try {
            $result['body'] = $this->branchService->delete($request->only(['id']));
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];

            return response()->json($result);
        }
        return response()->json($result, 200);
    }

    /**
     * Set branch status to active or inactive
     * 
     * @param Illuminate\Http\Request $request
     * @return JSON
     */
    public function status(Request $request)
    {

        try {
            $result['body'] = $this->branchService->status($request->only(['id']));
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];

            return response()->json($result);
        }
        return response()->json($result, 200);
    }

    /**
     * Get branch id details
     * 
     * @param App\Models\Branch $id
     * @return JSON
     */
    public function show(Branch $id)
    {
        try {
            return new BranchResource($id);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];

            return response()->json($result, 500);
        }
    }

    /**
     * Update Branch details by id
     * 
     * @param App\Http\Requests\Backend\BranchEditRequest $request
     * @param integer $id
     */
    public function update(BranchEditRequest $request, $id)
    {
        try {
            $result['id'] = $id;
            $result['success'] = $this->branchService->update($request->validated(), $id);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];

            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }


    public function itemsPerBranchTable()
    {
        try {
            return QueryBuilder::for(Branch::class)
                ->select([
                    'branches.id',
                    'branches.is_active',
                    'branches.name',
                    'branches.code',
                ])
                ->paginate(request()->query()['row'] ?? 10)
                ->onEachSide(1);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];

            return response()->json($result, 500);
        }
    }
}
