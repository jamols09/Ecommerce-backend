<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Backend\V1\Services\ItemService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ItemCreateRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function create(ItemCreateRequest $request)
    {
        // Log::debug($request);
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
}
