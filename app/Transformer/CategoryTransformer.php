<?php

namespace App\Transformer;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryTransformer
{
    public static function detail(Category $data)
    {
        return [
            'id' => $data->id,
            'name' => $data->name,
        ];
    }

    public static function getId(Category $data)
    {
        return $data->id;
    }

    public static function getByField(Category $data, $field)
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
