<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\BranchService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BranchCreateRequest;
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

    public function dropdown()
    {
        try {
            $result['body'] = $this->branchService->dropdown();
        }
        catch(Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
       
        return response()->json($result, 200);
    }

    public function create(BranchCreateRequest $request)
    {
        try {
            $result['body'] = $this->branchService->create($request->validated());
        }
        catch(Exception $e) {
            $result = [
                'error' => $e->getMessage(),
            ];
            return response()->json($result, 500);
        }
       
        return response()->json($result, 200);
    }

    public function table(Request $request)
    {
        try {
            $result['body'] = QueryBuilder::for(Branch::class)
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
        } catch (\Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];
            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    public function delete(Request $request)
    {
      
        try {
            $result['body'] = $this->branchService->delete($request);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];
          
            return response()->json($result);
        }
        return response()->json($result, 200);
    }

    public function status(Request $request)
    {
      
        try {
            $result['body'] = $this->branchService->status($request);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];
          
            return response()->json($result);
        }
        return response()->json($result, 200);
    }
}
