<?php

namespace App\Http\Backend\V1\Controller;

use App\Http\Controllers\Controller;

use App\Http\Backend\V1\Services\UserService;
use App\Http\Requests\Backend\UserCreateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Exception;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }
        return response()->json(['error' => 'Invalid Credentials'], 401);
    }

    /**
     * Generate user account
     * 
     * @param App\Http\Requests\Backend\UserCreateRequest
     * @return JSON
     */
    public function create(UserCreateRequest $request)
    {
        try {
            $result['body'] = $this->userService->create($request->validated());
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
     * Get paginated user list
     * 
     * @param Request $request
     * @return JSON
     */
    public function table()
    {
        try {
            $result['body'] = QueryBuilder::for(User::class)
                ->allowedFilters([
                    AllowedFilter::scope('account'),
                    'username',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'created_at',
                    'email',
                ])
                ->allowedSorts(
                    'username',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'created_at',
                    'email',
                    'is_active'
                )
                ->paginate(request()->query()['row'] ?? 10)
                ->onEachSide(1);
        } catch (Exception $e) {
            $result = [
                'error' => $e->getMessage(),
                'status' => 500,
            ];

            return response()->json($result, 500);
        }
        return response()->json($result, 200);
    }

    /**
     * Remove user
     * 
     * @param Request $request
     * @return JSON
     */
    public function delete(Request $request)
    {

        try {
            $result['body'] = $this->userService->delete($request);
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
     * Change user status
     * 
     * @param Request $request
     * @return JSON
     */
    public function status(Request $request)
    {

        try {
            $result['body'] = $this->userService->status($request);
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
