<?php

namespace App\Http\Middleware;

use App\Mail\NotifyAuthorCensoredProductReviewEmail;
use App\Repositories\ProductRepository;
use Closure;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CensorProductReviewMiddleware
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $product = $this->productRepository->find($request->id);

        $blockedReviews = config('app.blocked_review');
        $blockedReviews = explode(',', $blockedReviews);

        if (Str::contains($request->comment, $blockedReviews)) {
            Mail::to($product->author->email)->queue(new NotifyAuthorCensoredProductReviewEmail($product, $request->comment));
            abort(403, "Review's comment is not allowed");
        }
        return $next($request);
    }
}
