<?php

namespace App\Events;

use App\Product;
use App\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductReviewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;
    public $review;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product, Review $review)
    {
        $this->product = $product;
        $this->review = $review;
    }
}
