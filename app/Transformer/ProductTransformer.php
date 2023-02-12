<?php

namespace App\Transformer;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductTransformer
{
    public static function detail(Product $data)
    {
        return [
            'id' => $data->id,
            'name' => $data->name,
            'description' => $data->description,
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
