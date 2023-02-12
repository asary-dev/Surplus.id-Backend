<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\CreateImageValidation;
use App\Http\Requests\Image\GetAllImageByProductId;
use App\Http\Requests\Image\GetOneImageByIDValidation;
use App\Http\Requests\Image\UpdateImageValidation;
use App\Services\ImageServices;
use App\Transformer\ImageTransformer;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageServices $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getAll(Request $request, $product_id)
    {
        try {
            // also can pass filters from queries
            $validation = new GetAllImageByProductId($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $data = $this->imageService->getAllImagesByProductID($product_id);
            return response()->json([
                'status' => true,
                'data' => ImageTransformer::all($data),
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getOneByID(Request $request, $product_id, $id)
    {
        try {
            $validation = new GetOneImageByIDValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $data = $this->imageService->getOneById($id);

            return response()->json([
                'status' => true,
                'data' => ImageTransformer::detail($data),
            ], 200);

        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request, $product_id)
    {
        try {
            $validation = new CreateImageValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $image = $this->imageService->saveImage($validation->data);

            return response()->json([
                'status' => true,
                'message' => 'Successfully created.',
                'data' => ImageTransformer::getByField($image, 'id'),
            ], 200);
        } catch (\Throwable$th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }

    }

    public function update(Request $request, $product_id, $id)
    {
        try {
            $validation = new UpdateImageValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $this->imageService->updateImage($validation->data, $id);

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

    public function delete(Request $request, $product_id, $id)
    {
        try {
            $validation = new GetOneImageByIDValidation($request);
            if (!$validation->status) {
                return response()->json([
                    'status' => false,
                    'message' => $validation->message,
                ], 400);
            }

            $this->imageService->deleteImage($id, $product_id);

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
