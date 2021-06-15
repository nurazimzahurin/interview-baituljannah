<?php

namespace App\Http\Controllers;

use App\Events\ProductReviewed;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\ReviewProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\ReviewRepository;

class ProductController extends Controller
{
    private $productRepository;
    private $reviewRepository;

    public function __construct(ProductRepository $productRepository, ReviewRepository $reviewRepository)
    {
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productRepository->list();

        return view('pages.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->productRepository->create($request);

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        return view('pages.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        return view('pages.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productRepository->update($request, $id);

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(DeleteProductRequest $request, $id)
    {
        $deletedProduct = $this->productRepository->delete($id);

        return  $deletedProduct;
    }

    public function review(ReviewProductRequest $request, $id)
    {
        $review = $this->reviewRepository->addReview($request, $id);

        if (isset($review) && isset($review->product)) {
            event(new ProductReviewed($review->product, $review));
        }

        return $review;
    }

    public function checkProductOwner($id)
    {
        return $this->productRepository->checkIfUserIsProductOwner($id);
    }
}
