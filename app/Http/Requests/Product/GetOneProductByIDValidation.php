<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class GetOneProductByIDValidation extends Validation
{
    public static $rules = [
        "id" => ['required', 'string', 'max:255', 'exists:mysql.product,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        $request->merge(['id' => $request->id]);
        parent::__construct($request, $relations);
    }
}