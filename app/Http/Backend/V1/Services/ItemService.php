<?php

namespace App\Http\Backend\V1\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ItemService
{
	public function create($data)
	{

		$item = Item::create($data);

		foreach ($data['branches'] as $branch) {
			$item->branches()->attach($branch, [
				'is_active' => $data['is_active'],
				'is_display_qty' => $data['is_display_qty'],
				'quantity' => $data['quantity'],
				'quantity_warn' => $data['quantity_warn']
			]);
		}

		return $item->name;;
	}
}
