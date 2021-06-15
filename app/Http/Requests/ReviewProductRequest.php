<?php

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use App\Rules\CheckProductStockRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewProductRequest extends FormRequest
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'reviewer_id' => Auth::user()->id,
            'product_id' => request()->route('id')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'comment' => ['required', 'string'],
            'rating' => ['required', 'integer'],
            'reviewer_id' => ['required', 'exists:users,id'],
            'product_id' => ['required', 'exists:products,id', new CheckProductStockRule($this->productRepository)]
        ];
    }
}
