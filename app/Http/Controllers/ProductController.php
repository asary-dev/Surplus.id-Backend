<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductValidation;
use App\Http\Requests\Product\GetOneProductByIDValidation;
use App\Http\Requests\Product\UpdateProductValidation;
use App\Services\ProductServices;
use App\Transformer\ProductTransformer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServices $productService)
    {
        $this->productService = $productService;
    }

    public function getAll(Request $request)
    {
        try {
            $data = $this->productService->getAllCategories($request);
            return response()->json([
                'status' => true,
                'data' => ProductTransformer::all($data),
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getOneByID(Request $request, $id)
    {
        try {
            $validation = new GetOneProductByIDValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $data = $this->productService->getOneById($id);

            return response()->json([
                'status' => true,
                'data' => ProductTransformer::detail($data),
            ], 200);

        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validation = new CreateProductValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $product = $this->productService->saveProduct($validation->data);

            return response()->json([
                'status' => true,
                'message' => 'Successfully created.',
                'data' => ProductTransformer::getByField($product, 'id'),
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $validation = new UpdateProductValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $this->productService->updateProduct($validation->data, $id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully Updated.',
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $validation = new GetOneProductByIDValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $this->productService->deleteProduct($id);

            return response()->json([
                'status' => true,
                'message' => 'Successfully Deleted.',
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
