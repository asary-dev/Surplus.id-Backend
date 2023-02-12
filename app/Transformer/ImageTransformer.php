<?php

namespace App\Transformer;

use App\Models\Image;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ImageTransformer
{
    public static function detail(Image $data)
    {
        return [
            'id' => $data->id,
            'name' => $data->name,
            'url' => url('/') . Storage::url($data->file),
        ];
    }

    public static function getId(Image $data)
    {
        return $data->id;
    }

    public static function getByField(Image $data, $field)
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
