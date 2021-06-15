<?php

namespace App\Rules;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckProductStockRule implements Rule
{
    protected $productRepository;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = $this->productRepository->find($value);

        return $product->stock >= 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This product is out of stock';
    }
}
