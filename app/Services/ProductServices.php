<?php

namespace App\Services;

use App\Models\Product;
use Error;
use Exception;
use Illuminate\Http\Request;

class ProductServices
{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllCategories(Request $requests)
    {
        return $this->product->all();
    }

    public function getOneById($id)
    {
        return $this->product->findOrFail($id);
    }

    public function saveProduct($input)
    {
        try {
            $createdProduct = new $this->product;

            $createdProduct->fill($input);
            $createdProduct->save();

            return $createdProduct;
        } catch (Exception $e) {
            throw new Error($e);
        }
    }

    public function updateProduct($input, $id)
    {
        try {
            $updatedProduct = $this->getOneById($id);

            $updatedProduct->fill($input);
            $updatedProduct->save();

            return $updatedProduct;
        } catch (Exception $e) {
            throw new Error($e);
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = $this->getOneById($id);
            $product->delete();
            return true;
        } catch (Exception $e) {
            throw new Error($e);
        }
    }

    public function softDeleteProduct($id)
    {
    }

    public function recoverProduct()
    {
    }
}
