<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\BranchService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BranchCreateRequest;
use Illuminate\Http\Request;
use Exception;

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
            $result['body'] = $this->branchService->table($request);
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
