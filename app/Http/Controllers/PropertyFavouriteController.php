<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyFavouriteRequest;
use App\Interfaces\PropertyFavouriteRepositoryInterface;
use App\Traits\ResponseTrait;

class PropertyFavouriteController extends Controller
{
    use ResponseTrait;
    protected $propertyFavouriteRepository;

    public function __construct(PropertyFavouriteRepositoryInterface $propertyFavouriteRepository)
    {
        $this->propertyFavouriteRepository = $propertyFavouriteRepository;
    }

    public function index()
    {
        $favourite = $this->propertyFavouriteRepository->all();
        return $this->sendResponse($favourite, 'Get all Favourite properties successfully');
    }

    public function store(PropertyFavouriteRequest $request)
    {
        $favourite = $this->propertyFavouriteRepository->addFavourite($request->validated());
        return $this->sendResponse($favourite, 'Add Property to favourite successfully');
    }

    public function destroy($id)
    {
        $favourite=$this->propertyFavouriteRepository->removeFavourite($id);
        return $this->sendResponse($favourite, 'Deleted Property from favourite successfully');
    }
}

