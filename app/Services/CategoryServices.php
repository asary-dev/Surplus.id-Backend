<?php

namespace App\Services;

use App\Models\Category;
use Error;
use Exception;
use Illuminate\Http\Request;

class CategoryServices
{

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllCategories(Request $requests)
    {
        return $this->category->all();
    }

    public function getOneById($id)
    {
        return $this->category->findOrFail($id);
    }

    public function saveCategory($input)
    {
        try {
            $createdCategory = new $this->category;

            $createdCategory->fill($input);
            $createdCategory->save();

            return $createdCategory;
        } catch (Exception $e) {
            throw new Error($e);
        }
    }

    public function updateCategory($input, $id)
    {
        try {
            $updatedCategory = $this->getOneById($id);

            $updatedCategory->fill($input);
            $updatedCategory->save();

            return $updatedCategory;
        } catch (Exception $e) {
            throw new Error($e);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = $this->getOneById($id);
            $category->delete();
            return true;
        } catch (Exception $e) {
            throw new Error($e);
        }
    }

    public function softDeleteCategory($id)
    {
    }

    public function recoverCategory()
    {
    }
}
