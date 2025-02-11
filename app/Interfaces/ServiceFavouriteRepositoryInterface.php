<?php

namespace App\Interfaces;

interface ServiceFavouriteRepositoryInterface
{
    public function all();
    public function addFavourite(array $data);
    public function removeFavourite($id);
}

