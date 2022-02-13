<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'username' => $this->username,
            'first_name' => $this->first_name,
            'middle_name' => $this->middlename,
            'last_name' => $this->last_name,
            'birthdate' => $this->birthdate,
            'is_active' => $this->is_active,
            'email' => $this->email,
        ];
    }
}