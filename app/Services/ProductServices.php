<?php

namespace App\Services;

use App\Models\Product;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        return $this->product::with('categories')->findOrFail($id);
    }

    public function saveProduct($input)
    {
        DB::beginTransaction();
        try {
            $createdProduct = new $this->product;

            $createdProduct->fill($input);
            $createdProduct->save();

            Log::info(print_r($input, true));

            if ($input['categories']) {
                $createdProduct->categories()->attach($input['categories']);
            }

            // for detached uploads
            // if ($input['images']) {
            //     $createdProduct->categories()->attach($input['categories']);
            // }

            DB::commit();
            return $createdProduct;
        } catch (Exception $e) {
            DB::rollback();
            throw new Error($e);
        }
    }

    public function updateProduct($input, $id)
    {
        DB::beginTransaction();
        try {
            $updatedProduct = $this->getOneById($id);

            $updatedProduct->fill($input);
            $updatedProduct->save();

            if ($input['categories']) {
                $updatedProduct->categories()->sync($input['categories']);
            }

            DB::commit();
            return $updatedProduct;
        } catch (Exception $e) {
            DB::rollback();
            throw new Error($e);
        }
    }

    public function deleteProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->getOneById($id);
            $product->delete();

            $folder = "public/images/$id";
            if (Storage::exists($folder)) {
                Storage::deleteDirectory($folder);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
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
