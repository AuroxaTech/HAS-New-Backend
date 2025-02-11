<?php
namespace App\Repositories;

use App\Interfaces\TenantRepositoryInterface;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class TenantRepository implements TenantRepositoryInterface
{
    public function getAll()
    {
        return Tenant::all();
    }

    public function getById($id)
    {
        return Tenant::findOrFail($id);
    }

    public function create(array $data)
    {
        // Add user_id to the data array
        $data['user_id'] = Auth::id();
        return Tenant::create($data);
    }

    public function update($id, array $data)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->update($data);
        return $tenant;
    }

    public function delete($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();
        return $tenant;
    }
}
