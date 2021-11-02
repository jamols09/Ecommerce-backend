<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($data)
    {
        if(in_array('api_bypass',$data)) {
            $data = $this->userRepository->createApi($data);
        } else {
            $data = $this->userRepository->create($data);
        }
        //send email here
        return $data;
    }

}
