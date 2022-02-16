<?php

namespace App\Http\Backend\V1\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    /**
     * UserRepository constructor.
     *
     * @param User 
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create account via api call
     * @param array $data
     * @return App\Models\User
     */
    public function createApi(array $data)
    {
        return $this->user::create([
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'birthdate' => $data['birthdate'],
            'is_active' => $data['is_active'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'account_type' => $data['account_type']
        ]);
    }

    /**
     * Create account from admin
     * @param array $data
     * @return App\Models\User
     */
    public function create(array $data)
    {
        return $this->user::create([
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'birthdate' => $data['birthdate'],
            'is_active' => $data['is_active'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'account_type' => "ADMIN"
        ]);
    }
}
