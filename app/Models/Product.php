<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'enable',
    ];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id',
        );
    }

    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'product_image',
            'product_id',
            'image_id',
        );
    }

    public function deleteCategories()
    {
        $this->categories()->delete();
    }

    public function deleteImages()
    {
        $this->categories()->delete();
    }
}
