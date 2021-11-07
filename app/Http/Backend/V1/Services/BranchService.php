<?php

namespace App\Http\Backend\V1\Services;

use Exception;
use App\Http\Backend\V1\Repositories\BranchRepository;
use App\Models\Branch;

class BranchService
{
	protected $branchRepository;

	public function __construct(BranchRepository $branchRepository)
	{
		$this->branchRepository = $branchRepository;
	}

	public function create($data)
	{
		return $this->branchRepository->create($data);
	}

	public function dropdown()
	{
		return $this->branchRepository->dropdown();
	}

	public function table($data)
    {
        $query = Branch::query();

        switch (strtolower($data['type'])) {
            case 'name':
                $query = $query->where('name', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'code':
                $query = $query->where('code', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'city':
                $query = $query->where('city', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'barangay':
                $query = $query->where('barangay', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'line 1':
                $query =  $query->where('address_line_1', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'telephone':
                $query =  $query->where('telephone', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'mobile':
                $query =  $query->where('mobile', 'LIKE', '%' . $data['q'] . '%');
                break;
            case 'created at':
                $query = $query->where('created_at', 'LIKE', '%' . $data['q'] . '%');
                break;
            default:
                break;
        }

        if ($data['col']) {
            //override values
            $data['col'] = $data['col'] == 'Active' ? 'is_active' : $data['col'];
            $query = $query->orderBy(str_replace(' ', '_', $data['col'] ?? 'id'), $data['order'] ?? 'asc');
        }

        if ($data['row']) {
            $query = $query->paginate($data['row'] ?? 1)->onEachSide(1);
        }

        return $query;
    }

    /**
     * Delete all selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function delete($data)
    {
        foreach ($data['id'] as $value) {
            $query = Branch::find($value)->delete();
        }
        return $query;
    }

    /**
     * Set status of selected id
     * @param array $data
     * @return App\Models\Category
     */
    public function status($data)
    {
        foreach ($data['id'] as $value) {
            $query = Branch::find($value)->update(['is_active' => $data['status'] == 'activate' ? 1 : 0]);
        }
        return $query;
    }
}
