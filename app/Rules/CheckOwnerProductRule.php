<?php

namespace App\Rules;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Validation\Rule;

class CheckOwnerProductRule implements Rule
{
    protected $productId;
    protected $productRepository;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($productId, ProductRepository $productRepository)
    {
        $this->productId = $productId;
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
        $product = $this->productRepository->find($this->productId);

        return $product->author->id === $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are not allowed to perform this action';
    }
}
