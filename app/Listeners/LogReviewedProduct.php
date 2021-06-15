<?php

namespace App\Listeners;

use App\Events\ProductReviewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogReviewedProduct
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ProductReviewed $event
     * @return void
     */
    public function handle(ProductReviewed $event)
    {
        Log::info("Product name : ".$event->product->name." was reviewed: ".$event->review->comment);
    }
}
