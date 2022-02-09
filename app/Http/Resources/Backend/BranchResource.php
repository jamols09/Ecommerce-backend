<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'id' => $this->id,
            'is_active' => $this->is_active,
            'name' => $this->name,
            'code' => $this->code,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'barangay' => $this->barangay,
            'postal' => $this->postal,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'telephone' => $this->telephone,
            'mobile' => $this->mobile,
        ];
    }
}
