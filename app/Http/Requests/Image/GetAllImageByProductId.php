<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class GetAllImageByProductId extends Validation
{
    public static $rules = [
        "product_id" => ['required', 'numeric', 'exists:mysql.product,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {

        // also can pass filters from queries
        $request->merge(['product_id' => $request->product_id]);
        parent::__construct($request, $relations);
    }
}
