<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryGetOneByIDValidation;
use App\Http\Requests\Category\CreateCategoryValidation;
use App\Http\Requests\Category\UpdateCategoryValidation;
use App\Services\CategoryServices;
use App\Transformer\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServices $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        try {
            $data = $this->categoryService->getAllCategories($request);
            return response()->json([
                'status' => true,
                'data' => CategoryTransformer::all($data),
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $validation = new CategoryGetOneByIDValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $data = $this->categoryService->getOneById($id);

            return response()->json([
                'status' => true,
                'data' => CategoryTransformer::detail($data),
            ], 200);

        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validation = new CreateCategoryValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $category = $this->categoryService->saveCategory($validation->data);

            return response()->json([
                'status' => true,
                'message' => 'Successfully created.',
                'data' => CategoryTransformer::getByField($category, 'id'),
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
            $validation = new UpdateCategoryValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $this->categoryService->updateCategory($validation->data, $id);

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

    public function destroy(Request $request, $id)
    {
        try {
            $validation = new CategoryGetOneByIDValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $this->categoryService->deleteCategory($id);

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
