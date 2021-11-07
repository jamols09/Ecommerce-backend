<?php

namespace App\Http\Backend\V1\Services;

use App\Models\Item;

class ItemService
{
	public function create($data)
	{
		return Item::create($data);
	}
}
