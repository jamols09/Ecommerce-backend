<?php

namespace App\Http\Backend\V1\Services;

use App\Models\Branch;
use App\Models\BranchItem;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class ItemService
{

	/**
	 * Create item, will generate SKU if not provided
	 * 
	 * @param Array $data
	 * @return string name
	 */
	public function create(array $data): string
	{
		if (empty($data['sku'])) {
			$data['sku'] = $this->generateSKU();
		}

		$name = DB::transaction(function () use ($data) {
			$item = Item::create($data);
			$this->attachBranchItems($data, $item);
			return $item->name;
		});

		return $name;
	}

	/**
	 * Generate Unique SKU
	 * 
	 * @return string sku
	 */
	protected function generateSKU(string $sku = NULL)
	{
		$sku = Hashids::encode(Carbon::now()->getPreciseTimestamp(3));
		if (Item::uniqueSKU($sku)->count() > 0) {
			$this->generateSKU();
		}
		return $sku;
	}

	/**
	 * Generate item per branch on pivot table
	 * 
	 * @param Array $data
	 * @param App\Models\Item $item
	 */
	protected function attachBranchItems(array $data, Item $item): void
	{
		if ($data['branches'][0] != -1) {
			$item->branches()->attach($data['branches'], [
				'is_active' => $data['is_active'],
				'is_display_qty' => $data['is_display_qty'],
				'quantity' => $data['quantity'],
				'quantity_warn' => $data['quantity_warn'],
				'price' => $data['price'],
			]);
		} else {
			$id = Branch::pluck('id')->toArray();
			$item->branches()->syncWithPivotValues($id, [
				'is_active' => $data['is_active'],
				'is_display_qty' => $data['is_display_qty'],
				'quantity' => $data['quantity'],
				'quantity_warn' => $data['quantity_warn'],
				'price' => $data['price'],
			], false);
		}
	}

	/**
	 * Get items list based on branch id
	 * 
	 * @param array $data
	 * @return key,value id,name
	 */
	public function dropdown(array $data)
	{
		$branch = Branch::find($data['id']);
		// $item = $branch->items()->where('is_active', 1)->pluck('items.name', 'items.id');
		// or use get(['items.id','items.name']) but this will also display pivot columns on result
		return $branch->items()->where('is_active', 1)->get(['items.id', 'items.name']);;
	}

	/**
	 * Update item status columns: is_discountable
	 * 
	 * @param array $data
	 * @return null
	 */
	public function status(array $data)
	{
		$discountable = $data['state'] == 'discountable' ? 1 : 0;
		DB::transaction(function () use ($data, $discountable) {
			Item::where('id', $data['id'])->update(['is_discountable' => $discountable]);
		});
	}

	/**
	 * Update item status columns: is_discountable
	 * 
	 * @param array $data
	 * @param int id
	 * @return null
	 */
	public function updateItemOfBranch(array $data, int $id)
	{
		DB::transaction(function () use ($data, $id) {
			BranchItem::find($id)->update($data);
		});
	}
}
