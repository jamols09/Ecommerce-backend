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

    public function getDropdown()
    {
        try {
            $result['body'] = $this->branchService->getDropdown();
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
}
