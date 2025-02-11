<?php

namespace App\Http\Controllers;

use App\Interfaces\TenantRepositoryInterface;
use App\Http\Requests\TenantRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    use ResponseTrait;
    protected $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function index()
    {
        $tenants = $this->tenantRepository->getAll();
        return $this->sendResponse($tenants, 'Get Tenants successfully');
    }

    public function store(TenantRequest $request)
    {
        $data = $request->validated();
        $tenant = $this->tenantRepository->create($data);
        return $this->sendResponse($tenant, 'Store Tenant successfully');
    }


    public function show($id)
    {
        $tenant = $this->tenantRepository->getById($id);
        return $this->sendResponse($tenant, 'Show Tenant successfully');
    }

    public function update(TenantRequest $request, $id)
    {
        $data = $request->validated();
        $tenant = $this->tenantRepository->update($id, $data);
        return $this->sendResponse($tenant, 'Update Tenant successfully');
    }

    public function destroy($id)
    {
        $tenant = $this->tenantRepository->delete($id);
        return $this->sendResponse($tenant, 'Deleted Tenant successfully');
    }
}
