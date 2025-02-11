<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Interfaces\ReviewRepositoryInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ResponseTrait;

    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function store(ReviewRequest $request)
    {
        $review = $this->reviewRepository->addReview($request->validated());
        return $this->sendResponse($review, 'Review added successfully');
    }

    public function update($id, ReviewRequest $request)
    {
        $review = $this->reviewRepository->updateReview($id, $request->validated());
        return $this->sendResponse($review, 'Review updated successfully');
    }

    public function destroy($id)
    {
        $this->reviewRepository->deleteReview($id);
        return $this->sendResponse([], 'Review deleted successfully');
    }

    public function getReviewsByService($serviceId)
    {
        $reviews = $this->reviewRepository->getReviewsByService($serviceId);
        return $this->sendResponse($reviews, 'Reviews retrieved successfully');
    }
}

