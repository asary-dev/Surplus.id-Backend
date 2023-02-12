<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageServices
{

    protected $image;
    protected $product;

    public function __construct(Image $image, Product $product)
    {
        $this->image = $image;
        $this->product = $product;
    }

    public function getAllImagesByProductID($productId)
    {
        $product = $this->product->findOrFail($productId);
        return $product->images;
    }

    public function getOneById($id)
    {
        return $this->image->findOrFail($id);
    }

    public function saveImage($input)
    {
        DB::beginTransaction();
        try {
            $createdImage = new $this->image;
            $folder = "public/images/" . $input['product_id'];
            $findProduct = $this->product->findOrFail($input['product_id']);
            $nameSlug = Str::slug($input['name'], '-');

            // timestamperoo
            $imageName = time() . "-$nameSlug" . '.' . $input['image']->extension();
            $path = $input['image']->storeAs($folder, $imageName);

            $createdImage->fill([
                'file' => $path,
                'name' => $input['name'],
            ]);

            $createdImage->save();
            $findProduct->images()->attach($createdImage);

            DB::commit();
            return $createdImage;
        } catch (Exception $e) {
            DB::rollback();

            throw new Error($e);
        }
    }

    public function updateImage($input, $id)
    {
        DB::beginTransaction();
        try {
            $updatedImage = $this->getOneById($id);
            $folder = "public/images/" . $input['product_id'];
            $toBeDeleted = $updatedImage->file;

            $nameSlug = Str::slug($input['name'], '-');

            // timestamperoo
            $imageName = time() . "-$nameSlug" . '.' . $input['image']->extension();
            $path = $input['image']->storeAs($folder, $imageName);

            $updatedImage->fill([
                'file' => $path,
                'name' => $input['name'],
            ]);

            $updatedImage->save();

            if (Storage::exists($toBeDeleted)) {
                Storage::delete($toBeDeleted);
            }

            DB::commit();
            return $updatedImage;
        } catch (Exception $e) {
            DB::rollback();
            throw new Error($e);
        }
    }

    public function deleteImage($id, $productId)
    {
        DB::beginTransaction();
        try {
            $image = $this->getOneById($id);
            $toBeDeleted = $image->file;
            $image->delete();

            if (Storage::exists($toBeDeleted)) {
                Storage::delete($toBeDeleted);
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw new Error($e);
        }
    }

    public function softDeleteImage($id)
    {
    }

    public function recoverImage()
    {
    }
}
