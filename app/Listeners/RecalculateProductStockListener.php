<?php

namespace App\Listeners;

use App\Events\ProductReviewed;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RecalculateProductStockListener
{
    private $productRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductReviewed $event)
    {
        $updatedProductStock = $this->productRepository->recalculateProductStock($event->product);

        if (!$updatedProductStock) {
            Log::notice("Product Stock Recalculate Fails, Product id: ".$event->product->id." Review id: ".$event->review->id);
        }
    }
}
