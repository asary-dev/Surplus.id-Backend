<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class CreateProductValidation extends Validation
{

    public static $rules = [
        "name" => ['required', 'string', 'max:255'],
        "description" => ['required', 'string', 'max:255'],
        'categories' => ['required', 'array'],
        "categories.*" => ['required', 'numeric', 'exists:mysql.category,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        parent::__construct($request, $relations);
    }
}
