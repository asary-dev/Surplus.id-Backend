<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class GetOneProductByIDValidation extends Validation
{
    public static $rules = [
        "id" => ['required', 'numeric', 'exists:mysql.product,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        $request->merge(['id' => $request->id]);
        parent::__construct($request, $relations);
    }
}
