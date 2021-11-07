<?php

namespace App\Http\Backend\V1\Services;

use App\Models\Department;

class DepartmentService
{

	public function dropdown()
	{
		return Department::orderBy('name')->get(['id', 'name']);
	}

	public function create($data)
	{
		return Department::create($data);
	}

}
