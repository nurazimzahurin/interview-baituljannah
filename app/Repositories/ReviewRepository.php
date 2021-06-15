<?php


namespace App\Repositories;


use App\Review;

class ReviewRepository
{
    protected $model;

    public function __construct(Review $review)
    {
        $this->model = $review;
    }

    public function find($reviewId)
    {
        return $this->model->with(["product", "reviewer"])
            ->findOrFail($reviewId);
    }

    public function addReview($request, $productId)
    {
        $review =  $this->model->create([
            "title" => $request->title,
            "comment" => $request->comment,
            "rating" => $request->rating,
            "product_id" => $productId,
            "reviewer_id" => $request->reviewer_id
        ]);

        if (isset($review)) {
            $review = $this->find($review->id);
        }

        return $review;
    }
}
