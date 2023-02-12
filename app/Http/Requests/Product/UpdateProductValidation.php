<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class UpdateProductValidation extends Validation
{
    public static $rules = [
        "id" => ['required', 'numeric', 'exists:mysql.product,id'],
        'categories' => ['required', 'array'],
        "categories.*" => ['required', 'numeric', 'exists:mysql.category,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        static::$rules = array_merge(static::$rules, CreateProductValidation::$rules);
        $request->merge(['id' => $request->id]);
        parent::__construct($request, $relations);
    }
}
