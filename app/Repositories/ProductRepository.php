<?php


namespace App\Repositories;


use App\Product;
use Illuminate\Support\Facades\Auth;

class ProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function list()
    {
        return $this->model->with(["author"])
            ->latest("updated_at")
            ->paginate(15, ['name', 'description', 'created_at', 'id', 'author_id']);
    }

    public function find($productId)
    {
        return $this->model->with(["reviews.reviewer", "media", "author"])
            ->findOrFail($productId);
    }

    public function create($request)
    {
        $product = $this->model
            ->create([
                "name" => $request->name,
                "description" => $request->description,
                "currency" => $request->currency,
                "price" => (float)$request->price,
                "stock" => $request->stock,
                "author_id" => $request->author_id
            ]);

        if (isset($product)) {
            $product
                ->addMedia($request->product_image)
                ->toMediaCollection("picture");
        }

        return $product;
    }

    public function update($request, $productId)
    {
        $product = $this->find($productId);

        $product->update($request->all());

        return $product;
    }

    public function delete($productId)
    {
        $product = $this->find($productId);
        unset($product->media);
        unset($product->reviews);

        if ($product->delete()) {
            return true;
        }
        return false;
    }

    public function recalculateProductStock(Product $product)
    {
        $currentStock = $product->stock;
        $updatedProduct = $product->update([
            "stock" => $currentStock - 1
        ]);

        return $updatedProduct;
    }

    public function checkIfUserIsProductOwner($productId)
    {
        $product = $this->find($productId);

        return Auth::user()->id == $product->author_id;
    }
}
