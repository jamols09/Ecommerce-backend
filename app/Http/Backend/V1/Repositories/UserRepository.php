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
     * @param User 
     */

    public function createApi($data)
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

    /**
     * Create account from admin
     */
    public function create($data)
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
