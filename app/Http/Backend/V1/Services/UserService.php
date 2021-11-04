<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\UserRepository;
use App\Models\User;
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

    public function table($data)
    {
        $query = $data['u'] == 'a' ? User::query()->admin() : User::query()->client();

        switch (strtolower($data['type'])) {
            case 'username':
                $query = $query->where('username', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'firstname':
                $query = $query->where('first_name', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'middlename':
                $query = $query->where('middle_name', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'lastname':
                $query = $query->where('last_name', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'fullname':
                $query = $query->orWhereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like ?", ['%' . $data['q'] . '%']);
            case 'created at':
                $query = $query->where('created_at', 'LIKE', '%' . $data['q'] . '%');
                break;
            default:
                # code...
                break;
        }

        if ($data['col']) {
            $query = $query->orderBy(str_replace(' ', '_', $data['col'] ?? 'id'), $data['order'] ?? 'asc');
        }

        if ($data['row']) {
            $query = $query->paginate($data['row'] ?? 1)->onEachSide(1);
        }

        return $query;
    }

     /**
     * Delete all selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function deactivate($data)
    {
        foreach ($data['id'] as $value) {
            $query = User::find($value)->update(['is_active' => 0]);
        }

        return $query;
    }
}
