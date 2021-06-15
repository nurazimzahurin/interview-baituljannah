<?php

namespace App\Http\Requests;

use App\Repositories\ProductRepository;
use App\Rules\CheckOwnerProductRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteProductRequest extends FormRequest
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
            'author_id' => Auth::user()->id,
            'product_id' => request()->route('product')
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
            "author_id" => ['required', 'exists:users,id', new CheckOwnerProductRule($this->product_id, $this->productRepository)]
        ];
    }
}
