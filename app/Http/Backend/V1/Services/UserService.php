<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        if (in_array('api_bypass', $data)) {
            $data = $this->userRepository->createApi($data);
        } else {
            $data = $this->userRepository->create($data);
        }
        //send email here
        return $data;
    }

    /**
     * Delete all selected id
     * 
     * @param array $data
     * @return User
     */
    public function delete($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data['id'] as $value) {
                $query = User::find($value)->delete();
            }
            return $query;
        });
    }

    /**
     * Set status of selected id
     * 
     * @param array $data
     * @return App\Models\Category
     */
    public function status($data)
    {
        DB::transaction(function () use ($data) {
            foreach ($data['id'] as $value) {
                $query = User::find($value)->update(['is_active' => $data['status'] == 'activate' ? 1 : 0]);
            }
            return $query;
        });
    }
}
