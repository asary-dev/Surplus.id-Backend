<?php

namespace App\Transformer;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductTransformer
{
    public static function detail(Product $data)
    {
        $categories = $data->categories ? $data->categories : null;
        $images = $data->images ? $data->images : null;
        return [
            'id' => $data->id,
            'name' => $data->name,
            'description' => $data->description,
            "categories" => $categories ? CategoryTransformer::all($categories) : [],
            "images" => $images ? ImageTransformer::all($images) : [],
        ];
    }

    public static function getId(Product $data)
    {
        return $data->id;
    }

    public static function getByField(Product $data, $field)
    {
        return $data[$field];
    }

    public static function all(Collection $data)
    {
        return $data->transform(function ($item, $key) {
            return self::detail($item);
        });
    }
}
