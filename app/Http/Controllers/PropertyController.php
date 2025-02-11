<?php

namespace App\Http\Controllers;

use App\Interfaces\PropertyRepositoryInterface;
use App\Http\Requests\PropertyRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    use ResponseTrait;
    protected $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        $properties = $this->propertyRepository->all();
        return $this->sendResponse($properties, 'Get all properties successfully');
    }

    public function store(PropertyRequest $request)
    {
        $data = $request->validated();
        $property = $this->propertyRepository->create($data);
        return $this->sendResponse($property, 'Store property successfully');
    }

    public function show($id)
    {
        $property = $this->propertyRepository->find($id);
        return $this->sendResponse($property, 'Show property successfully');
    }

    public function update(Request $request, $id)
    {
        $property = $this->propertyRepository->update($id, $request->all());
        return $this->sendResponse($property, 'Update  property successfully');
    }

    public function destroy($id)
    {
        $property = $this->propertyRepository->delete($id);
        return $this->sendResponse($property, 'Deleted property successfully');
    }

    public function getPropertyImages($property_id)
    {
        $properties = $this->propertyRepository->getPropertyImages($property_id);
        return $this->sendResponse($properties, 'Get all properties images successfully');
    }

    public function updatePropertyImages(Request $request, $id)
    {
        $property = $this->propertyRepository->updatePropertyImages($id, $request->all());
        return $this->sendResponse($property, 'Update  property image successfully');
    }

    public function destroyPropertyImages($id)
    {
        $property = $this->propertyRepository->deletePropertyImages($id);
        return $this->sendResponse($property, 'Deleted property image successfully');
    }
}
