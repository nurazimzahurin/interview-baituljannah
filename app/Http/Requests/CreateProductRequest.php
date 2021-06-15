<?php

namespace App\Http\Requests;

use App\Rules\CheckOwnerProductRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateProductRequest extends FormRequest
{
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
            "name" => ['required', 'string'],
            "description" => ['required', 'string'],
            "currency" => ['required', 'string', 'min:2', 'max:3'],
            "price" => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            "stock" => ['required', 'integer'],
            "product_image" => ['required', 'image'],
            "author_id" => ['required', 'exists:users,id']
        ];
    }
}
