<?php

namespace App\Http\Backend\V1\Services;

use App\Models\Branch;
use App\Models\Item;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Log;
use Nette\Utils\Strings;

class ItemService
{

	/**
	 * Create item and create items per branch on pivot table
	 * 
	 * @param Array $data
	 * @return string name
	 */
	public function create($data): string
	{
		if(empty($data['sku'])) {
			$data['sku'] = Hashids::encode(Carbon::now()->getPreciseTimestamp(3));
		}
		$item = Item::create($data);

		foreach ($data['branches'] as $branch) {
			$item->branches()->attach($branch, [
				'is_active' => $data['is_active'],
				'is_display_qty' => $data['is_display_qty'],
				'quantity' => $data['quantity'],
				'quantity_warn' => $data['quantity_warn']
			]);
		}

		return $item->name;
	}

	/**
	 * Get items list based on branch id
	 * 
	 * @return key,value id,name
	 */
	public function dropdown($id)
	{
		$branch = Branch::find($id['id']);
		$item = $branch->items()->where('is_active', 1)->pluck('items.name','items.id'); 
		// or use get(['items.id','items.name']) but this will also display pivot columns on result

		return $item;
	}
}
