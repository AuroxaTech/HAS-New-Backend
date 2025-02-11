<?php
namespace App\Repositories;

use App\Interfaces\ReviewRepositoryInterface;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function addReview(array $data)
    {
        $data['user_id'] = Auth::id(); // Automatically set the authenticated user ID
        return Review::create($data);
    }

    public function updateReview($id, array $data)
    {
        $review = Review::findOrFail($id);
        $review->update($data);
        return $review;
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return true;
    }

    public function getReviewsByService($serviceId)
    {
        return Review::with('user','service')->where('user_id', $serviceId)->get();
    }
}
