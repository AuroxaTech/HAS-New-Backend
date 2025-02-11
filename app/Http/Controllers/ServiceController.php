<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Interfaces\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    use ResponseTrait;
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $services = $this->serviceRepository->getAll();
        return $this->sendResponse($services, 'Get all services successfully');
    }

    public function show($id)
    {
        $service = $this->serviceRepository->getById($id);
        return $this->sendResponse($service, 'Show service successfully');
    }

    public function store(ServiceRequest $request)
    {
        $service = $this->serviceRepository->create($request->validated());
        return $this->sendResponse($service, 'Store service successfully');
    }

    public function update(Request $request, $id)
    {
        $service = $this->serviceRepository->update($id, $request->all());
        return $this->sendResponse($service, 'Update service successfully');
    }

    public function destroy($id)
    {
        $service = $this->serviceRepository->delete($id);
        return $this->sendResponse($service, 'Deleted service successfully');
    }

    public function getServiceImages($service_id)
    {
        $properties = $this->serviceRepository->getServiceImages($service_id);
        return $this->sendResponse($properties, 'Get all services images successfully');
    }

    public function updateServiceImages(Request $request, $id)
    {
        $property = $this->serviceRepository->updateServiceImages($id, $request->all());
        return $this->sendResponse($property, 'Update  services image successfully');
    }

    public function destroyServiceImages($id)
    {
        $property = $this->serviceRepository->deleteServiceImages($id);
        return $this->sendResponse($property, 'Deleted service image successfully');
    }
}
