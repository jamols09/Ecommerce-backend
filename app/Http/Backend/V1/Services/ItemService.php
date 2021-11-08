<?php

namespace App\Http\Backend\V1\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ItemService
{
	public function create($data)
	{

		$item = Item::create([
			'department_id' => $data['department_id'],
			'brand_id' => $data['brand_id'],
			'is_discountable' => $data['is_discountable'],
			'sku' => $data['sku'],
			'name' => $data['name'],
			'description' => $data['description'],
			'color' => $data['color'],
			'size' => $data['size'],
			'material' => $data['material'],
			'weight_unit' => $data['weight_unit'],
			'weight_amount' => $data['weight_amount'],
			'length' => $data['length'],
			'width' => $data['width'],
			'height' => $data['height'],
		]);

		foreach ($data['branches'] as $branch) {
			$item->branches()->attach($branch, [
				'is_active' => $data['is_active'],
				'is_display_qty' => $data['is_display_qty'],
				'quantity' => $data['quantity'],
				'quantity_warn' => $data['quantity_warn']
			]);
		}
	}
}
