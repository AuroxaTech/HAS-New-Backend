<?php

namespace App\Interfaces;

interface ReviewRepositoryInterface
{
    
    public function addReview(array $data);

    public function updateReview($id, array $data);

    public function deleteReview($id);

    public function getReviewsByService($serviceId);
}

