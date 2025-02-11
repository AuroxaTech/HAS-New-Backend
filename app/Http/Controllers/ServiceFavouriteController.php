<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceFavouriteRequest;
use App\Interfaces\ServiceFavouriteRepositoryInterface;
use App\Traits\ResponseTrait;

class ServiceFavouriteController extends Controller
{
    use ResponseTrait;
    protected $serviceFavouriteRepository;

    public function __construct(ServiceFavouriteRepositoryInterface $serviceFavouriteRepository)
    {
        $this->serviceFavouriteRepository = $serviceFavouriteRepository;
    }

    public function index()
    {
        $favourite = $this->serviceFavouriteRepository->all();
        return $this->sendResponse($favourite, 'Get all Favourite Service successfully');
    }

    public function store(ServiceFavouriteRequest $request)
    {
        $favourite = $this->serviceFavouriteRepository->addFavourite($request->validated());
        return $this->sendResponse($favourite, 'Add Service to favourite successfully');
    }

    public function destroy($id)
    {
        $favourite=$this->serviceFavouriteRepository->removeFavourite($id);
        return $this->sendResponse($favourite, 'Deleted Service from favourite successfully');
    }
}

