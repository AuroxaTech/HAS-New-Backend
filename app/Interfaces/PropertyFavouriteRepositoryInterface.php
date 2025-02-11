<?php

namespace App\Interfaces;

interface PropertyFavouriteRepositoryInterface
{
    public function all();
    public function addFavourite(array $data);
    public function removeFavourite($id);
}

