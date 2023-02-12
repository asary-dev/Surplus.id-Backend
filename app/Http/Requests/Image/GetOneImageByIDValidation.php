<?php

namespace App\Http\Requests\Image;

use App\Http\Requests\Validation;
use Illuminate\Http\Request;

class GetOneImageByIDValidation extends Validation
{
    public static $rules = [
        "id" => ['required', 'numeric', 'exists:mysql.image,id'],
        "product_id" => ['required', 'numeric', 'exists:mysql.product,id'],
    ];

    public function __construct(Request $request, array $relations = [])
    {
        $request->merge(['id' => $request->id]);
        $request->merge(['product_id' => $request->product_id]);
        parent::__construct($request, $relations);
    }
}
